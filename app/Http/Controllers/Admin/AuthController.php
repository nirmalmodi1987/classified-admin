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
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function showProfile()
    {
        return view('admin.profile.show');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $admin = Auth::guard('admin')->user();
        $admin->update($request->validated());
        return back()->with('success', 'Profile updated successfully');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $admin = Auth::guard('admin')->user();
        $admin->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with('success', 'Password updated successfully');
    }

    // Password reset methods remain the same
    public function showForgotPasswordForm()
    {
        return view('admin.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // Implementation needed
    }

    public function showResetPasswordForm($token)
    {
        return view('admin.auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        // Implementation needed
    }
}