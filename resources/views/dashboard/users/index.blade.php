@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manajemen User</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary mb-3">Tambah User Baru</a>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $userItem)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $userItem->name }}</td>
                                        <td>{{ $userItem->email }}</td>
                                        <td>{{ ucfirst($userItem->role) }}</td>
                                        <td>
                                            <form action="{{ route('dashboard.users.destroy', $userItem->id) }}"
                                                method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger mb-2 swal-confirm"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus user ini?')"><i
                                                        class="bi bi-trash-fill"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
