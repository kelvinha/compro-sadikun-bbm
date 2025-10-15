<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class UserController extends SuperAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = 25;
        $user = User::latest()->paginate($perPage);
        $data['user'] = $user;
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'string', 'min:8'],
                'role_id' => 'required|exists:roles,id',
                'avatar' => 'nullable|image|max:2048',
                'is_active' => 'boolean',
            ]);

            // Create new user
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = $request->role_id;
            $user->is_active = $request->has('is_active');

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = 'avatar_' . time() . '.' . $avatar->getClientOriginalExtension();
                $path = $avatar->storeAs('avatars', $filename, 'public');
                $user->avatar = $path;
            }

            $user->save();
            $this->success('User created successfully!');

            return redirect()->route('admin.users.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation errors are automatically handled by Laravel
            // But we can add a custom error message for better UX
            $this->error('Please check the form for errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            // Handle any other exceptions
            $this->error('Failed to create user. Please try again. Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $data['user'] = $user;
        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$id,
                'password' => ['nullable', 'string', 'min:8'],
                'role_id' => 'required|exists:roles,id',
                'avatar' => 'nullable|image|max:2048',
                'is_active' => 'boolean',
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->is_active = $request->has('is_active');

            // Update password if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // Delete old avatar if exists
                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }

                $avatar = $request->file('avatar');
                $filename = 'avatar_' . time() . '.' . $avatar->getClientOriginalExtension();
                $path = $avatar->storeAs('avatars', $filename, 'public');
                $user->avatar = $path;
            }

            $user->save();
            $this->success('User updated successfully!');

            return redirect()->route('admin.users.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation errors are automatically handled by Laravel
            // But we can add a custom error message for better UX
            $this->error('Please check the form for errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle case where user is not found
            $this->error('User not found.');
            return redirect()->route('admin.users.index');

        } catch (\Exception $e) {
            // Handle any other exceptions
            $this->error('Failed to update user. Please try again. Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            // Prevent deleting current user
            if ($user->id === auth()->id()) {
                $this->error('You cannot delete your own account.');
                return redirect()->route('admin.users.index');
            }

            // Prevent deleting superadmin if current user is not superadmin
            if ($user->isSuperAdmin() && !auth()->user()->isSuperAdmin()) {
                $this->error('You do not have permission to delete a superadmin user.');
                return redirect()->route('admin.users.index');
            }

            // Delete avatar file if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $userName = $user->name;
            $user->delete();

            $this->success("User '{$userName}' deleted successfully!");
            return redirect()->route('admin.users.index');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $this->error('User not found.');
            return redirect()->route('admin.users.index');

        } catch (\Exception $e) {
            $this->error('Failed to delete user. Please try again. Error: ' . $e->getMessage());
            return redirect()->route('admin.users.index');
        }
    }

    /**
     * Show the form for changing the user's password.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function changePassword($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.change-password', compact('user'));
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'password' => ['required', 'string', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        $this->success('Password changed successfully');

        return redirect()->route('admin.users.show', $id);
    }
}
