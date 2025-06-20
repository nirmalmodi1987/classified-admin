@extends('admin.layouts.app')

@section('title', 'Edit Category: ' . $category->name)

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Category</h3>
        <div class="card-tools">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Category Name *</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $category->name) }}" required>
                        @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="slug">URL Slug *</label>
                        <input type="text" name="slug" id="slug"
                            class="form-control @error('slug') is-invalid @enderror"
                            value="{{ old('slug', $category->slug) }}" required>
                        @error('slug')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="parent_id">Parent Category</label>
                        <select name="parent_id" id="parent_id"
                            class="form-control @error('parent_id') is-invalid @enderror">
                            <option value="">-- No Parent --</option>
                            @foreach($parentCategories as $parent)
                            @if($parent->id !== $category->id) {{-- Prevent self-parenting --}}
                            <option value="{{ $parent->id }}"
                                {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                        @error('parent_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="icon">Icon Class (Font Awesome)</label>
                        <input type="text" name="icon" id="icon"
                            class="form-control @error('icon') is-invalid @enderror"
                            value="{{ old('icon', $category->icon) }}"
                            placeholder="fas fa-icon-name">
                        <small class="form-text text-muted">
                            Current:
                            @if($category->icon)
                            <i class="{{ $category->icon }}"></i>
                            @else
                            No icon set
                            @endif
                        </small>
                        @error('icon')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input"
                        id="is_active" name="is_active" value="1"
                        {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="is_active">Active Category</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Update Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection