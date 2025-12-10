@extends('admin.layouts.master')
@section('page-title', 'Edit Customer')

@section('admin-content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Edit Customer: {{ $customer->name }}</h4>
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left me-1"></i> Back to Customers</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('customers.update', $customer) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $customer->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $customer->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">New Password <small class="text-muted">(leave blank to keep current)</small></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $customer->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save me-1"></i> Update Customer
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
