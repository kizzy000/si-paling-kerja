@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid p-0">
        <h1 class="h3">Daftar Perusahaan</h1>
        <form method="GET" action="{{ route('dashboard.pendaftar.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search_perusahaan" class="form-control" placeholder="Cari nama perusahaan..." value="{{ request('search_perusahaan') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Perusahaan</th>
                                        <th>Lihat Pendaftar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lowongans as $lowongan)
                                        <tr>
                                            <td>{{ $loop->iteration + ($lowongans->currentPage() - 1) * $lowongans->perPage() }}</td>
                                            <td><img src="{{ asset('storage/'. $lowongan->gambar) }}" alt="gambar-perusahaan" style="width: 250px"; height="200px"></td>
                                            <td>{{ $lowongan->perusahaan }}</td>
                                            <td>
                                                <a href="{{ route('dashboard.pendaftar.pendaftar', $lowongan->slug) }}" class="btn btn-success"><i class="bi bi-eye-fill"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $lowongans->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

