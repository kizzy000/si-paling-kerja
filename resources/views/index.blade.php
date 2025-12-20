@extends('layouts.main')


@section('container')

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">
      <div class="container">
        <div class="row gy-4 d-flex justify-content-between">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h2 data-aos="fade-up">KERJA !!!</h2>
            <p data-aos="fade-up" data-aos-delay="100">Sistem Informasi CARI KERJA merupakan Tempat Cari Lowongan Kerja dapat diakses secara mudah dan dimana saja</p>


			  <a href="/lowongan" class="btn btn-primary">Lowongan Kerja Terbaru <a class="bi bi-arrow-right"></a></i>
            </form>

            <div class="row gy-4" data-aos="fade-up" data-aos-delay="400">

              <div class="col-lg-3 col-6">
                <div class="stats-item text-center w-100 h-100">

                  <p></p>
                </div>
              </div><!-- End Stats Item -->


              <div class="col-lg-3 col-6">
                <div class="stats-item text-center w-100 h-100">

                  <p></p>
                </div>
              </div><!-- End Stats Item -->

              <div class="col-lg-3 col-6">
                <div class="stats-item text-center w-100 h-100">

                  <p></p>
                </div>
              </div><!-- End Stats Item -->

            </div>
          </div>

          <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="assets/img/hero.png" class="img-fluid mb-3 mb-lg-0" alt="">
          </div>

        </div>
      </div>
    </section><!-- End Hero Section -->

    <!-- ======= Services Section ======= -->
    <section id="service" class="services pt-0">
        <div class="container" data-aos="fade-up">
          <div class="section-header">
              <span>Lowongan Terbaru</span>
              <h2>Lowongan Terbaru</h2>
          </div>

          <div class="row">
            @foreach($lowongans as $lowongan)
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
          <a href="/lowongan" class="btn btn-primary position-absolute bottom-20 start-50 translate-middle-x">Selengkapnya <i class="bi bi-arrow-right"></i></a>
        </div>
      </section><!-- End Services Section -->
@endsection
