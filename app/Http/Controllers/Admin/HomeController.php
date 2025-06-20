<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the admin home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.auth.login');
    }
}
