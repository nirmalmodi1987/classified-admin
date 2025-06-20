<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{

    public function showProfile()
    {
        return view('admin.profile.show');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // public function updateProfile(UpdateProfileRequest $request)
    // {
    //     $user = Auth::guard('admin')->user();

    //     // Explicitly update only allowed fields
    //     $user->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         // Add other fillable fields here
    //     ]);

    //     return back()->with('success', 'Profile updated successfully');
    // }

    public function updateProfile(UpdateProfileRequest $request)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->back()->with('error', 'Not authenticated');
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return back()->with('success', 'Profile updated successfully');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with('success', 'Password updated successfully');
    }

    // Password reset methods
    public function showForgotPasswordForm()
    {
        return view('admin.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // Implement password reset logic
    }

    public function showResetPasswordForm($token)
    {
        return view('admin.auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        // Implement password reset logic
    }
    // public function logout(Request $request)
    // {
    //     Auth::guard('admin')->logout();
    //     return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    // }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login'); // Ensure this matches
    }
}
