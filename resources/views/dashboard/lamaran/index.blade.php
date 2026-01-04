@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid p-0">
        <h1 class="h3">Data lamaran Anda</h1>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Perusahaan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lamaran as $list)
                                        <tr>
                                            <td>{{ $loop->iteration + ($lamaran->currentPage() - 1) * $lamaran->perPage() }}</td>
                                            <td>{{ $list->lowongan->perusahaan }}</td>
                                            <td>
                                                <a href=" {{  route('dashboard.lamaran.edit', $list->id  ) }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                                                <form id="{{ $list->id }}" action="{{ route('dashboard.lamaran.destroy', $list->id ) }}" method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="btn btn-danger swal-confirm" data-form="{{ $list->id }}"><i class="bi bi-trash-fill"></i></div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{-- {{ $lamaran->links('pagination::bootstrap-5') }} --}}
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

