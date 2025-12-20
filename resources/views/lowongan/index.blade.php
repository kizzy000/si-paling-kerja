@extends('layouts.main')

@section('container')
<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row d-flex justify-content-between">
        <div class="section-header">
            <h2>Lowongan Terbaru</h2>
        </div>
      </div>
    </div>
</section>

   <!-- ======= Services Section ======= -->
   <section id="service" class="services pt-0">
        <div class="container my-5" data-aos="fade-up">
            <div class="row">
                @foreach ($lowongans as $lowongan)
                @php
                    $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lowongan->batas_waktu);
                    $diff = $end_date->diff(\Carbon\Carbon::now());
                @endphp
                <div class="col-md-4 mb-4">
                  <div class="card h-100">
                      <div class="card-body d-flex flex-column">
                        <img src="{{ asset('storage/' . $lowongan->gambar) }}" class="card-img-top" alt="{{ $lowongan->judul }}">
                          <h5 class="card-title">{{ $lowongan->judul }}</h5>
                          <p class="card-text">Perusahaan: {{ $lowongan->perusahaan }}</p>
                            <div class="mt-auto">
                                    <h6 class="card-text text-danger">
                                        @if($diff->days > 0)
                                            Sisa Waktu: {{ $diff->days }} hari, {{ $diff->h }} jam
                                        @else
                                            Pendaftaran Di Tutup
                                        @endif
                                    </h6>
                                <a href="{{ route('lowongan.show', $lowongan->slug) }}" class="mt-auto btn btn-primary">Lihat Detail</a>
                            </div>
                      </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
  </section>
@endsection
