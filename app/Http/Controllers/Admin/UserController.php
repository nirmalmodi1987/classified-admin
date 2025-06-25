<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Index with search
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%")
                    ->orWhere('phone', 'like', "%{$request->search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    // Create form
    public function create()
    {
        return view('admin.users.create');
    }

    // Store new user
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:8|confirmed',
        //     'phone' => 'nullable|string|max:20',
        //     'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        //     'is_active' => 'boolean',
        //     'is_verified' => 'boolean'
        // ]);


        $data = $request->except('avatar', 'password_confirmation');
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        User::create($data);
        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    // Edit form
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
            'is_verified' => 'boolean'
        ]);

        $data = $request->except('avatar');

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    // Delete user
    public function destroy(User $user)
    {
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();
        return back()->with('success', 'User moved to trash!');
    }

    // Toggle active status
    public function toggleActive(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
        return back()->with('success', 'Status updated!');
    }

    // Toggle verification
    public function toggleVerified(User $user)
    {
        $user->update([
            'is_verified' => !$user->is_verified,
            'email_verified_at' => $user->is_verified ? now() : null
        ]);
        return back()->with('success', 'Verification updated!');
    }

    // Update password
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user->update(['password' => $request->password]);
        return back()->with('success', 'Password updated!');
    }
}
