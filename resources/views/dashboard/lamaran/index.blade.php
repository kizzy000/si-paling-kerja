@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid p-0">
        @if(Auth::user()->isPerusahaan())
            <h1 class="h3">Data Lamaran untuk Lowongan Anda</h1>
        @else
            <h1 class="h3">Data lamaran Anda</h1>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    @if(Auth::user()->isPerusahaan())
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelamar</th>
                                            <th>Lowongan</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <th>No</th>
                                            <th>Perusahaan</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </tr>
                                    @endif
                                </thead>
                                <tbody>
                                    @foreach ($lamaran as $list)
                                        @if(Auth::user()->isPerusahaan())
                                            <tr>
                                                <td>{{ $loop->iteration + ($lamaran->currentPage() - 1) * $lamaran->perPage() }}</td>
                                                <td>{{ $list->user->name }}</td>
                                                <td>{{ $list->lowongan->judul }}</td>
                                                <td>
                                                    <span class="badge
                                                        @if($list->status == 'pending') bg-warning
                                                        @elseif($list->status == 'accepted') bg-success
                                                        @else bg-danger
                                                        @endif">
                                                        {{ ucfirst($list->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.lamaran.edit-status', $list->id) }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $loop->iteration + ($lamaran->currentPage() - 1) * $lamaran->perPage() }}</td>
                                                <td>{{ $list->lowongan->perusahaan }}</td>
                                                <td>
                                                    <span class="badge
                                                        @if($list->status == 'pending') bg-warning
                                                        @elseif($list->status == 'accepted') bg-success
                                                        @else bg-danger
                                                        @endif">
                                                        {{ ucfirst($list->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.lamaran.edit', $list->id) }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                                                    <form id="{{ $list->id }}" action="{{ route('dashboard.lamaran.destroy', $list->id) }}" method="POST" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="btn btn-danger swal-confirm" data-form="{{ $list->id }}"><i class="bi bi-trash-fill"></i></div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $lamaran->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

