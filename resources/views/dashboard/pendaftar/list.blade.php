@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid p-0">
        <h1 class="h3">Data Pendaftar {{ $lowongan->perusahaan }}</h1>
        <a href="{{ route('dashboard.pendaftar.index') }}" type="button" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
        <form method="GET" action="{{ route('dashboard.pendaftar.pendaftar', $lowongan->slug) }}" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="search_nama" class="form-control" placeholder="Cari nama..." value="{{ request('search_nama') }}">
                </div>
                <div class="col-md-3">
                    <select name="jenis_kelamin" class="form-select">
                        <option value="">Semua Jenis Kelamin</option>
                        <option value="laki-laki" {{ request('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ request('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
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
                                        <th>Nama</th>
                                        <th>Kode Pendaftaran</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>Jurusan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Asal Sekolah</th>
                                        <th>Kuliah</th>
                                        <th>No Telepon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lamarans as $list)
                                        <tr>
                                            <td>{{ $loop->iteration + ($lamarans->currentPage() - 1) * $lamarans->perPage() }}</td>
                                            <td>{{ $list->user->name }}</td>
                                            <td>{{ $list->kode_pendaftaran }}</td>
                                            <td>{{ $list->tanggal_lahir }}</td>
                                            <td>{{ $list->alamat }}</td>
                                            <td>{{ $list->user->email }}</td>
                                            <td>{{ $list->jurusan }}</td>
                                            <td>{{ $list->jenis_kelamin }}</td>
                                            <td>{{ $list->asal_sekolah }}</td>
                                            <td>{{ $list->kuliah }}</td>
                                            <td>{{ $list->no_telepon }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $lamarans->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

