@extends('admin.app')   

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Quick Stats -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalAds }}</h3>
                    <p>Total Ads</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ad"></i>
                </div>
                <a href="{{ route('admin.ads.index') }}" class="small-box-footer">
                    View All <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $activeAds }}</h3>
                    <p>Active Ads</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <a href="{{ route('admin.ads.index', ['status' => 'active']) }}" class="small-box-footer">
                    View Active <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $pendingAds }}</h3>
                    <p>Pending Approval</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
                <a href="{{ route('admin.ads.index', ['status' => 'pending']) }}" class="small-box-footer">
                    Review Now <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalUsers }}</h3>
                    <p>Registered Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                    Manage Users <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Recent Activities -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Ads</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentAds as $ad)
                                <tr>
                                    <td>{{ $ad->id }}</td>
                                    <td>{{ Str::limit($ad->title, 30) }}</td>
                                    <td>{{ $ad->category->name ?? 'N/A' }}</td>
                                    <td>{{ config('classified.currency_symbol') }}{{ number_format($ad->price, 2) }}</td>
                                    <td>
                                        <span class="badge badge-{{ $ad->status === 'active' ? 'success' : ($ad->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($ad->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.ads.show', $ad->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No ads found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Actions</h3>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('admin.ads.create') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-plus-circle mr-2"></i> Create New Ad
                        </a>
                        <a href="{{ route('admin.categories.create') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-tag mr-2"></i> Add New Category
                        </a>
                        <a href="{{ route('admin.locations.create') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-map-marker-alt mr-2"></i> Add New Location
                        </a>
                        <a href="{{ route('admin.users.create') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user-plus mr-2"></i> Add New User
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Recent Users -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Recent Users</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="users-list clearfix">
                        @foreach($recentUsers as $user)
                        <li>
                            <img src="{{ $user->avatar_url }}" alt="User Image" width="50">
                            <a class="users-list-name" href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a>
                            <span class="users-list-date">{{ $user->created_at->diffForHumans() }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
