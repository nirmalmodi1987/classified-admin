<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalAds' => Ad::count(),
            'activeAds' => Ad::where('is_active', '1')->count(),
            'pendingAds' => Ad::where('is_active', '0')->count(),
            'totalUsers' => User::count(),
            'recentAds' => Ad::with('category')->latest()->take(5)->get(),
            'recentUsers' => User::latest()->take(8)->get()
        ]);
    }
}
