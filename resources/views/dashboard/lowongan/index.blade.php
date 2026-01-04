@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid p-0">
        <h1 class="h3">Semua Lowongan</h1>
        <a href="{{ route('dashboard.lowongan.create') }}" type="button" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Posting Baru</a>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form method="GET" action="{{ route('dashboard.lowongan.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search_judul" class="form-control" placeholder="Cari judul lowongan..." value="{{ request('search_judul') }}">
                </div>
                <div class="col-md-3">
                    <select name="sort" class="form-select">
                        <option value="">Urutkan</option>
                        <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                    </select>
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
                            <table class="table table-striped" id="table_Lowongan">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Perusahaan</th>
                                        <th>Posisi</th>
                                        <th>Batas Waktu</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lowongans as $lowongan)
                                        <tr>
                                            <td>{{ $loop->iteration + ($lowongans->currentPage() - 1) * $lowongans->perPage() }}</td>
                                            <td>{{ $lowongan->judul }}</td>
                                            <td>{{ $lowongan->perusahaan }}</td>
                                            <td>{{ $lowongan->posisi }}</td>
                                            <td>{{ $lowongan->batas_waktu }}</td>
                                            <td>
                                                <a href="{{ route('dashboard.lowongan.show', $lowongan->slug ) }}" class="btn btn-success mb-2"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{ route('dashboard.lowongan.edit', $lowongan->slug ) }}" class="btn btn-warning  mb-2"><i class="bi bi-pencil-fill"></i></a>
                                                <form id="{{ $lowongan->slug }}" action="{{ route('dashboard.lowongan.destroy', $lowongan->id) }}" method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="btn btn-danger mb-2 swal-confirm" data-form="{{ $lowongan->slug }}"><i class="bi bi-trash-fill"></i></div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $lowongans->links('pagination::bootstrap-5') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

