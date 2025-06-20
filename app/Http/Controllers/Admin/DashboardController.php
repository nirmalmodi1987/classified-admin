<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        echo "Hello";
        exit;
        return view('admin.dashboard', [
            'totalAds' => Ad::count(),
            'totalUsers' => User::count(),
            'recentAds' => Ad::latest()->take(5)->get()
        ]);
    }
}
