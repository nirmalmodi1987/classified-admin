@extends('admin.layouts.app')

@section('title', 'Category Details: ' . $category->name)

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Category Details</h3>
        <div class="card-tools">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">ID</th>
                        <td>{{ $category->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>
                            @if($category->icon)
                            <i class="{{ $category->icon }} mr-1"></i>
                            @endif
                            {{ $category->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $category->slug }}</td>
                    </tr>
                    <tr>
                        <th>Parent Category</th>
                        <td>{{ $category->parent->name ?? '-' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Status</th>
                        <td>
                            <span class="badge badge-{{ $category->is_active ? 'success' : 'danger' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $category->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $category->updated_at->format('M d, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Total Subcategories</th>
                        <td>{{ $category->children->count() }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.categories.edit', $category->id) }}"
                class="btn btn-primary">
                <i class="fas fa-edit mr-1"></i> Edit Category
            </a>
        </div>
    </div>
</div>
@endsection