@extends('admin.layouts.app')

@section('title', 'Create New Category')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create New Category</h3>
        <div class="card-tools">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Category Name *</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" required autofocus>
                        @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="slug">URL Slug *</label>
                        <div class="input-group">
                            <input type="text" name="slug" id="slug"
                                class="form-control @error('slug') is-invalid @enderror"
                                value="{{ old('slug') }}" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="generateSlug()">
                                    <i class="fas fa-sync-alt"></i> Generate
                                </button>
                            </div>
                            @error('slug')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
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
                            <option value="{{ $parent->id }}"
                                {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
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
                            value="{{ old('icon') }}"
                            placeholder="fas fa-icon-name">
                        <small class="form-text text-muted">
                            Example: fas fa-car, fas fa-home
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
                        {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="is_active">Active Category</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Create Category
                </button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    function generateSlug() {
        const name = document.getElementById('name').value;
        const slug = name.toLowerCase()
            .replace(/\s+/g, '-') // Replace spaces with -
            .replace(/[^\w\-]+/g, '') // Remove all non-word chars
            .replace(/\-\-+/g, '-') // Replace multiple - with single -
            .replace(/^-+/, '') // Trim - from start of text
            .replace(/-+$/, ''); // Trim - from end of text

        document.getElementById('slug').value = slug;
    }
</script>
@endsection
@endsection