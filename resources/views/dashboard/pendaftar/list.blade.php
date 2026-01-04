@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid p-0">
        <h1 class="h3">Data Pendaftar {{ $lowongan->perusahaan }}</h1>
        <a href="{{ route('dashboard.pendaftar.index') }}" type="button" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
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
                                    @foreach ($lowongan->lamarans as $list)
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

