@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid p-0">
    <div class="row mt-5">
        <div class="col-md-8 mx-auto">
            <h1 class="h3 mb-3">Form Pendaftaran {{ $lowongan->perusahaan }}</h1>
            <a href="{{ route('dashboard.lowongan-tersedia.index') }}" type="button" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
            <div class="card">

                <div class="card-body">
                    <form action="{{ route('dashboard.lowongan-tersedia.store', $lowongan->id ) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="lowongan_id" value="{{ $lowongan->id }}">
                        <input type="hidden" name="kode_pendaftaran" id="kode_pendaftaran">

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ auth()->user()->name }}" disabled>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat">
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ auth()->user()->email }}" disabled>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan">
                                    @error('jurusan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                    <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" id="asal_sekolah" name="asal_sekolah">
                                    @error('asal_sekolah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kuliah" class="form-label">Kuliah</label>
                                    <input type="text" class="form-control @error('kuliah') is-invalid @enderror" id="kuliah" name="kuliah">
                                    @error('kuliah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">jenis Kelamin</label>
                                    <select class="form-select @error('jenis_kelamin') is-invalid @enderror" aria-label="Default select example" name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="">--- Pilih ---</option>
                                        <option value="laki-laki">Laki-laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="no_telepon" class="form-label">Phone</label>
                                    <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon">
                                    @error('no_telepon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>




                                <button type="submit" class="btn btn-primary float-end">Daftar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
