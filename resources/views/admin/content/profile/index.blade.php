@extends('admin.layouts.master')
@section('page-title', 'My Profile')

@section('admin-content')
    <div class="page-content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="mb-4">
                                <div class="avatar-lg mx-auto">
                                    @if(auth()->user()->avatar)
                                        <img src="{{ asset('storage/' . auth()->user()->avatar->thumb_path) }}" alt="{{ auth()->user()->name }}" class="rounded-circle img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                        <div class="avatar-title bg-primary text-white rounded-circle" style="width: 80px; height: 80px; font-size: 32px; line-height: 80px;">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                            <p class="text-muted mb-3">{{ auth()->user()->email }}</p>
                            <span class="badge bg-success">{{ auth()->user()->is_admin ? 'Administrator' : 'User' }}</span>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Account Info</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label text-muted">Member Since</label>
                                <p class="mb-0">{{ auth()->user()->created_at->format('F d, Y') }}</p>
                            </div>
                            <div class="mb-0">
                                <label class="form-label text-muted">Email Verified</label>
                                <p class="mb-0">
                                    @if(auth()->user()->email_verified_at)
                                        <span class="badge bg-success">Verified</span>
                                    @else
                                        <span class="badge bg-warning">Not Verified</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Update Profile</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Profile Avatar</label>
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" accept="image/*">
                                    @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save me-1"></i> Update Profile
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Change Password</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.profile.password') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">New Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fa fa-key me-1"></i> Change Password
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
