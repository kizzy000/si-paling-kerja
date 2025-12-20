@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-10 mx-auto d-block">
                <h1 class="h3">Detail Informasi</h1>
                <a href="{{ route('dashboard.informasi.index') }}" type="button" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
                <div class="card">
                    <div class="card-body">
                        <h1 class="mt-3">{{ $informasi->judul }}</h1>
                        <p><img src="{{ asset('storage/' .$informasi->file) }}" alt="" style="overflow:hidden; border: 1px solid black" class="img-fluid mb-5"></p>
                        <p>{!! $informasi->deskripsi !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
