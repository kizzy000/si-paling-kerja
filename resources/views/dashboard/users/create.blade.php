@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Tambah User Baru</h1>

        <a href="{{ route('dashboard.users.index') }}" type="button" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('dashboard.users.store') }}" class="mb-5">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" required autofocus>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" required>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role User</label>
                                        <select class="form-select @error('role') is-invalid @enderror" name="role">
                                            <option value="pendaftar" {{ old('role') == 'pendaftar' ? 'selected' : '' }}>Pendaftar</option>
                                            <option value="perusahaan" {{ old('role') == 'perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                                            {{-- Sembunyikan admin jika ingin sesuai filter sebelumnya --}}
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="alert alert-info small">
                                        <i class="bi bi-info-circle"></i> Pastikan email yang didaftarkan aktif untuk keperluan login.
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-end">Buat User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
