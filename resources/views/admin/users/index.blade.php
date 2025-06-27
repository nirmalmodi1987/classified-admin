@extends('adminlte::page')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-sm-6">
            <h1 class="m-0">Users Management</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i>Add New User
            </a>
        </div>
    </div>
    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif

    @if ($message = Session::get('error'))

        <div class="alert alert-danger">

            <p>{{ $message }}</p>

        </div>

    @endif
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.users.index') }}" method="GET" class="form-inline">
                <div class="input-group w-100">
                    <input type="text" name="search" class="form-control" placeholder="Search name, email or phone..."
                        value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Verified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="img-circle" width="40">
                            @else
                            <div class="img-circle bg-secondary text-center"
                                style="width:40px;height:40px;line-height:40px;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td>
                            <form action="{{ route('admin.users.toggle-active', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="btn btn-sm btn-{{ $user->is_active ? 'success' : 'secondary' }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.users.toggle-verified', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="btn btn-sm btn-{{ $user->is_verified ? 'info' : 'warning' }}">
                                    {{ $user->is_verified ? 'Verified' : 'Unverified' }}
                                </button>
                            </form>
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-info mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection