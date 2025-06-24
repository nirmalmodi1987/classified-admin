<?php echo "jeasdasdasd";
 ?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel --> 
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                @auth('admin')
                <a href="{{ route('admin.profile.show') }}" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
                @else
                <a href="{{ route('admin.login') }}" class="d-block">Login</a>
                @endauth
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Ads Management -->
                <li class="nav-item has-treeview {{ request()->is('admin/ads*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/ads*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-ad"></i>
                        <p>
                            Ads Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.ads.index') }}" class="nav-link {{ request()->is('admin/ads') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Ads</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ads.create') }}" class="nav-link {{ request()->is('admin/ads/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New Ad</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ads.index', ['status' => 'pending']) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending Approval</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Categories -->
                <li class="nav-item has-treeview {{ request()->is('admin/categories*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Categories
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->is('admin/categories') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.create') }}" class="nav-link {{ request()->is('admin/categories/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New Category</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Locations -->
                <li class="nav-item has-treeview {{ request()->is('admin/locations*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/locations*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map-marker-alt"></i>
                        <p>
                            Locations
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.locations.index') }}" class="nav-link {{ request()->is('admin/locations') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Locations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.locations.create') }}" class="nav-link {{ request()->is('admin/locations/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New Location</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- User Management -->
                <li class="nav-item has-treeview {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.create') }}" class="nav-link {{ request()->is('admin/users/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New User</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Profile -->
                <li class="nav-item">
                    <a href="{{ route('admin.profile.show') }}" class="nav-link {{ request()->is('admin/profile*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>My Profile</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>