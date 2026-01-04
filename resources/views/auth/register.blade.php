@extends('layouts.auth.app')
@section('content')
    <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
        <div class="text-center text-md-center mb-4 mt-md-0">
            <h1 class="mb-0 h3">Create your account</h1>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('register.submit') }}" class="mt-4" method="POST">
            @csrf
            <!-- Name -->
            <div class="form-group mb-4">
                <label for="name">Your Name</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input type="text" class="form-control" placeholder="Your Name" id="name" name="name" value="{{ old('name') }}" required>
                </div>
            </div>
            <!-- Email -->
            <div class="form-group mb-4">
                <label for="email">Your Email</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon2">
                        <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                    </span>
                    <input type="email" class="form-control" placeholder="example@company.com" id="email" name="email" value="{{ old('email') }}" required>
                </div>
            </div>
            <!-- Password -->
            <div class="form-group mb-4">
                <label for="password">Password</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon3">
                        <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input type="password" placeholder="Password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <!-- Confirm Password -->
            <div class="form-group mb-4">
                <label for="password_confirmation">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon4">
                        <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input type="password" placeholder="Confirm Password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>
            <!-- Role -->
            <div class="form-group mb-4">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="">Select Role</option>
                    <option value="pendaftar" {{ old('role') == 'pendaftar' ? 'selected' : '' }}>Pendaftar</option>
                    <option value="perusahaan" {{ old('role') == 'perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                </select>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-gray-800">Create account</button>
            </div>
        </form>
        <div class="d-flex justify-content-center align-items-center mt-4">
            <span class="fw-normal">
                Already have an account?
                <a href="{{ route('login.form') }}" class="fw-bold">Sign in</a>
            </span>
        </div>
    </div>
@endsection
