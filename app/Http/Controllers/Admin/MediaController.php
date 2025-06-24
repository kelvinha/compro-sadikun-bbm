<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Media::query();

        // Filter by category if provided
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $media = $query->orderBy('created_at', 'desc')->get();
        $categories = Media::getCategories();
        $selectedCategory = $request->category;

        return view('admin.media.index', compact('media', 'categories', 'selectedCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Media::getCategories();
        return view('admin.media.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'name' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'caption' => 'nullable|string',
            'category' => 'nullable|string|in:' . implode(',', array_keys(Media::getCategories())),
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getMimeType();
        $size = $file->getSize();
        $fileHash = md5_file($file->getRealPath());

        // Generate a unique filename
        $filename = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '_' . time() . '.' . $extension;

        // Store the file
        $path = $file->storeAs('public/media', $filename);

        // Create media record
        $media = new Media();
        $media->user_id = Auth::id();
        $media->name = $request->name ?? pathinfo($originalName, PATHINFO_FILENAME);
        $media->file_name = $filename;
        $media->mime_type = $mimeType;
        $media->path = 'media/' . $filename;
        $media->disk = 'public';
        $media->file_hash = $fileHash;
        $media->size = $size;
        $media->alt_text = $request->alt_text;
        $media->caption = $request->caption;
        $media->category = $request->category;
        $media->save();

        $this->success('Media uploaded successfully');

        return redirect()->route('admin.media.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\View\View
     */
    public function show(Media $media)
    {
        return view('admin.media.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\View\View
     */
    public function edit(Media $media)
    {
        $categories = Media::getCategories();
        return view('admin.media.edit', compact('media', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Media $media)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'caption' => 'nullable|string',
            'category' => 'nullable|string|in:' . implode(',', array_keys(Media::getCategories())),
        ]);

        $media->name = $request->name;
        $media->alt_text = $request->alt_text;
        $media->caption = $request->caption;
        $media->category = $request->category;
        $media->save();

        $this->success('Media updated successfully');

        return redirect()->route('admin.media.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Media $media)
    {
        // Delete the file
        Storage::delete('public/' . $media->path);

        // Delete the record
        $media->delete();

        $this->success('Media deleted successfully');

        return redirect()->route('admin.media.index');
    }

    /**
     * Upload media via AJAX.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getMimeType();
        $size = $file->getSize();
        $fileHash = md5_file($file->getRealPath());

        // Generate a unique filename
        $filename = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '_' . time() . '.' . $extension;

        // Store the file
        $path = $file->storeAs('public/media', $filename);

        // Create media record
        $media = new Media();
        $media->user_id = Auth::id();
        $media->name = pathinfo($originalName, PATHINFO_FILENAME);
        $media->file_name = $filename;
        $media->mime_type = $mimeType;
        $media->path = 'media/' . $filename;
        $media->disk = 'public';
        $media->file_hash = $fileHash;
        $media->size = $size;
        $media->save();

        return response()->json([
            'success' => true,
            'media' => $media,
            'url' => asset('storage/' . $media->path),
        ]);
    }

    /**
     * Get all media via AJAX.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $media = Media::orderBy('created_at', 'desc')->get();

        $media->transform(function ($item) {
            $item->url = asset('storage/' . $item->path);
            $item->human_size = $item->human_size;
            $item->is_image = $item->is_image;
            return $item;
        });

        return response()->json([
            'success' => true,
            'media' => $media,
        ]);
    }

    /**
     * Handle batch upload of multiple files.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpload(Request $request)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'file|max:10240', // 10MB max per file
        ]);

        $uploadedFiles = [];
        $errors = [];

        foreach ($request->file('files') as $file) {
            try {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $mimeType = $file->getMimeType();
                $size = $file->getSize();
                $fileHash = md5_file($file->getRealPath());

                // Generate a unique filename
                $filename = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '_' . time() . '_' . uniqid() . '.' . $extension;

                // Store the file
                $path = $file->storeAs('public/media', $filename);

                // Create media record
                $media = new Media();
                $media->user_id = Auth::id();
                $media->name = pathinfo($originalName, PATHINFO_FILENAME);
                $media->file_name = $filename;
                $media->mime_type = $mimeType;
                $media->path = 'media/' . $filename;
                $media->disk = 'public';
                $media->file_hash = $fileHash;
                $media->size = $size;
                $media->save();

                $uploadedFiles[] = [
                    'id' => $media->id,
                    'name' => $media->name,
                    'url' => asset('storage/' . $media->path),
                    'size' => $media->human_size,
                    'type' => $media->mime_type,
                ];
            } catch (\Exception $e) {
                $errors[] = [
                    'file' => $originalName,
                    'error' => $e->getMessage(),
                ];
            }
        }

        return response()->json([
            'success' => count($errors) === 0,
            'uploaded' => $uploadedFiles,
            'errors' => $errors,
            'message' => count($uploadedFiles) . ' files uploaded successfully' . (count($errors) > 0 ? ', ' . count($errors) . ' failed' : ''),
        ]);
    }
}
