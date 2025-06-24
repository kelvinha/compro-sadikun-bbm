<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'file_name',
        'mime_type',
        'path',
        'disk',
        'file_hash',
        'size',
        'alt_text',
        'caption',
        'category',
    ];

    /**
     * Available media categories
     */
    const CATEGORIES = [
        'home' => 'Home',
        'about' => 'About',
        'contact' => 'Contact',
        'services' => 'Services',
        'projects' => 'Projects',
        'blog' => 'Blog',
        'general' => 'General',
    ];

    /**
     * Get available categories for dropdown
     *
     * @return array
     */
    public static function getCategories()
    {
        return self::CATEGORIES;
    }

    /**
     * Get the user that owns the media.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the full URL to the media file.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }

    /**
     * Get the human-readable file size.
     *
     * @return string
     */
    public function getHumanSizeAttribute()
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Check if the media is an image.
     *
     * @return bool
     */
    public function getIsImageAttribute()
    {
        return strpos($this->mime_type, 'image/') === 0;
    }

    /**
     * Check if the media is a video.
     *
     * @return bool
     */
    public function getIsVideoAttribute()
    {
        return strpos($this->mime_type, 'video/') === 0;
    }

    /**
     * Check if the media is a document.
     *
     * @return bool
     */
    public function getIsDocumentAttribute()
    {
        $documentTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        ];

        return in_array($this->mime_type, $documentTypes);
    }
}
