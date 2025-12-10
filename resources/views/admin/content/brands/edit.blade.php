@extends('admin.layouts.master')
@section('page-title', 'Edit Brand')

@section('admin-content')
    <!-- start Page content -->
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Edit Brand: {{ $brand->name }}</h4>
                            <a href="{{ route('brands.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left me-1"></i> Back to Brands</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Brand Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $brand->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                            id="slug" name="slug" value="{{ old('slug', $brand->slug) }}">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="logo" class="form-label">Brand Logo</label>
                                        @if($brand->logo)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" style="height: 60px;" class="border rounded p-1">
                                                <small class="d-block text-muted">Current logo</small>
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                            id="logo" name="logo" accept="image/*">
                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Leave empty to keep current logo. Accepted formats: JPEG, PNG, JPG, GIF, SVG, WebP. Max size: 2MB</small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save me-1"></i> Update Brand
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page content -->
@endsection
