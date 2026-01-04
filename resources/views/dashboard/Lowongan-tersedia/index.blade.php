@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid p-0">
        <h1 class="h3">Daftar Perusahaan</h1>
        <form method="GET" action="{{ route('dashboard.lowongan-tersedia.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama perusahaan..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="sort" class="form-select">
                        <option value="">Semua</option>
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
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Perusahaan</th>
                                        <th>Posisi</th>
                                        <th>Batas Waktu</th>
                                        <th>Daftar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lowongan as $lowongans)
                                    @php
                                        $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lowongans->batas_waktu);
                                        $diff = $end_date->diff(\Carbon\Carbon::now());
                                    @endphp
                                        <tr>
                                            <td>{{ $loop->iteration + ($lowongan->currentPage() - 1) * $lowongan->perPage() }}</td>
                                            <td><img src="{{ asset('storage/'. $lowongans->gambar) }}" alt="gambar-perusahaan" style="width: 250px"; height="200px"></td>
                                            <td>{{ $lowongans->perusahaan }}</td>
                                            <td>{{ $lowongans->posisi }}</td>
                                            <td>{{ $lowongans->batas_waktu }}</td>
                                            <td>
                                                {{-- Mengecek apakah user yang sedang login sudah mendaftar di lowongan ini atau belum --}}
                                                @if($lowongans->lamarans->contains('user_id', Auth::id()))
                                                    <button type="button" class="btn btn-danger"><i class="bi bi-x-square"> </i>Anda sudah mendaftar</button>
                                                @else
                                                    @if($diff->days > 0)
                                                        <a href="{{ route('dashboard.lowongan-tersedia.daftar', $lowongans->slug) }}" class="btn btn-success"><i class="bi bi-person-plus"></i></a>
                                                    @else
                                                        <button type="button" class="btn btn-danger"><i class="bi bi-x-square"> </i>Pendaftaran Telah Berakhir</button>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                            <div class="mt-3">
                                {{ $lowongan->links('pagination::bootstrap-5') }}
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

