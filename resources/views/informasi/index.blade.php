@extends('layouts.main')

@section('container')
<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row d-flex justify-content-between">
        <div class="section-header">
            <h2>Informasi</h2>
        </div>
      </div>
    </div>
</section>

   <!-- ======= Services Section ======= -->
   <section id="service" class="services pt-0">
        <div class="container my-5" data-aos="fade-up">
            <div class="row">
                @foreach ($informasis as $informasi)
                <div class="col-md-4 mb-4">
                  <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <img src="{{ asset('storage/'. $informasi->file) }}" alt="">
                            <h5 class="card-title">{{ $informasi->judul }}</h5>
                            <p class="card-text">{{ Str::limit(strip_tags($informasi->deskripsi), 100) }}</p>
                            <a href="{{ route('informasi.show', $informasi->slug) }}" class="mt-auto btn btn-info">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
  </section>
@endsection
