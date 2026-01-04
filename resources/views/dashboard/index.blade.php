@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Dashboard</strong></h1>
        @if (Auth::check())


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Selamat Datang, {{ auth()->user()->name }}</h3>
                        @if(auth()->user()->isAdmin())
                            <span class="badge bg-primary">Administrator</span>
                        @elseif(auth()->user()->isPerusahaan())
                            <span class="badge bg-secondary">Perusahaan</span>
                        @else
                            <span class="badge bg-success">Pendaftar</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if(auth()->user()->isPerusahaan())
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="text-primary">{{ $totalLowongan ?? 0 }}</h2>
                        <p class="text-muted">Total Lowongan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="text-success">{{ $totalLamaran ?? 0 }}</h2>
                        <p class="text-muted">Total Lamaran</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="text-warning">{{ $pendingLamaran ?? 0 }}</h2>
                        <p class="text-muted">Lamaran Pending</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row mt-4">
            @if(auth()->user()->isAdmin())
                <!-- Admin Dashboard Cards -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-buildings text-primary" style="font-size: 3rem;"></i>
                            <h5 class="mt-2">Kelola Lowongan</h5>
                            <p class="text-muted">Buat dan kelola lowongan kerja</p>
                            <a href="{{ route('dashboard.lowongan.index') }}" class="btn btn-primary btn-sm">Kelola</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-info-square text-info" style="font-size: 3rem;"></i>
                            <h5 class="mt-2">Kelola Informasi</h5>
                            <p class="text-muted">Publikasikan informasi penting</p>
                            <a href="{{ route('dashboard.informasi.index') }}" class="btn btn-info btn-sm">Kelola</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-people-fill text-success" style="font-size: 3rem;"></i>
                            <h5 class="mt-2">Kelola Lamaran</h5>
                            <p class="text-muted">Review dan kelola lamaran masuk</p>
                            <a href="{{ route('dashboard.pendaftar.index') }}" class="btn btn-success btn-sm">Kelola</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-people-fill text-success" style="font-size: 3rem;"></i>
                            <h5 class="mt-2">Kelola User</h5>
                            <p class="text-muted">Review dan kelola User masuk</p>
                            <a href="{{ route('dashboard.users.index') }}" class="btn btn-success btn-sm">Kelola</a>
                        </div>
                    </div>
                </div>
            @elseif(auth()->user()->isPerusahaan())
                <!-- Perusahaan Dashboard Cards -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-briefcase text-primary" style="font-size: 3rem;"></i>
                            <h5 class="mt-2">Kelola Lowongan</h5>
                            <p class="text-muted">Posting dan kelola lowongan kerja</p>
                            <a href="{{ route('dashboard.lowongan.index') }}" class="btn btn-primary btn-sm">Kelola</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                            <h5 class="mt-2">Seleksi Pelamar</h5>
                            <p class="text-muted">Review dan seleksi lamaran</p>
                            <a href="{{ route('dashboard.lamaran.index') }}" class="btn btn-success btn-sm">Seleksi</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-person-circle text-info" style="font-size: 3rem;"></i>
                            <h5 class="mt-2">Profil Perusahaan</h5>
                            <p class="text-muted">Kelola informasi perusahaan</p>
                            <a href="{{ route('dashboard.profil.index') }}" class="btn btn-info btn-sm">Edit</a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Pendaftar Dashboard Cards -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-search text-primary" style="font-size: 3rem;"></i>
                            <h5 class="mt-2">Cari Lowongan</h5>
                            <p class="text-muted">Temukan lowongan kerja impian</p>
                            <a href="{{ route('dashboard.lowongan-tersedia.index') }}" class="btn btn-primary btn-sm">Cari</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-file-earmark-text text-warning" style="font-size: 3rem;"></i>
                            <h5 class="mt-2">Lamaran Saya</h5>
                            <p class="text-muted">Pantau status lamaran Anda</p>
                            <a href="{{ route('dashboard.lamaran.index') }}" class="btn btn-warning btn-sm">Lihat</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="bi bi-person-circle text-info" style="font-size: 3rem;"></i>
                            <h5 class="mt-2">Profil Saya</h5>
                            <p class="text-muted">Kelola informasi pribadi</p>
                            <a href="{{ route('dashboard.profil.index') }}" class="btn btn-info btn-sm">Edit</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @else
        <div class="alert alert-warning" role="alert">
            Anda belum login. Silakan <a href="{{ route('login.form') }}" class="alert-link">login</a> untuk mengakses dashboard.
        </div>
        @endif
    </div>
@endsection
