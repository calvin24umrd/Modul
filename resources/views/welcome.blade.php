@extends('layouts.main')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient text-white py-5 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 order-lg-1">
                <h1 class="display-5 fw-bold mb-3">
                    Temukan Teman <span class="text-warning">Berbulu Kesayanganmu</span>
                </h1>
                <p class="lead mb-4 opacity-75">
                    Temukan hewan peliharaan favoritmu di PetShop Market. Teman setia menanti Anda di rumah.
                </p>
                <div class="d-flex flex-column flex-sm-row gap-2">
                    <div class="position-relative flex-grow-1">
                        <i class="bi bi-search position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
                        <input class="form-control form-control-lg ps-5 rounded-pill border-0 shadow-sm" placeholder="Cari kucing, anjing, dll..." type="text">
                    </div>
                    <button class="btn btn-warning btn-lg rounded-pill px-4 shadow-sm">
                        <i class="bi bi-search me-2"></i>Cari Sekarang
                    </button>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 text-center mb-4 mb-lg-0">
                <img alt="Happy pets" class="img-fluid rounded-4 shadow-lg" style="max-height: 350px;" src="https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=600&h=400&fit=crop">
            </div>
        </div>
    </div>
</section>

<!-- Main Content Container -->
<div class="container pb-5">
    <!-- Stats Section -->
    <section class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3">
                        <i class="bi bi-heart-fill text-success fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Total Hewan</p>
                        <h4 class="fw-bold mb-0">{{ $hewan->count() }}+</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3">
                        <i class="bi bi-people-fill text-info fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Total User</p>
                        <h4 class="fw-bold mb-0">8,500+</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                        <i class="bi bi-receipt text-warning fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Total Transaksi</p>
                        <h4 class="fw-bold mb-0">24.3K</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Category Cards -->
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold mb-1">Kategori Hewan</h2>
                <p class="text-muted mb-0">Temukan hewan sesuai kebutuhan Anda.</p>
            </div>
        </div>
        <div class="row g-4">
            @php
                $kategori = [
                    ['icon' => 'bi-heart', 'nama' => 'Anjing', 'jumlah' => '120+', 'color' => 'danger'],
                    ['icon' => 'bi-lightning', 'nama' => 'Kucing', 'jumlah' => '85+', 'color' => 'info'],
                    ['icon' => 'bi-bird', 'nama' => 'Burung', 'jumlah' => '200+', 'color' => 'success'],
                    ['icon' => 'bi-droplet', 'nama' => 'Ikan', 'jumlah' => '150+', 'color' => 'primary'],
                ];
            @endphp
            @foreach($kategori as $kat)
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm text-center h-100 hover-lift cursor-pointer transition-all">
                    <div class="card-body py-4">
                        <div class="rounded-circle bg-{{ $kat['color'] }} bg-opacity-10 mx-auto mb-3 d-inline-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                            <i class="bi {{ $kat['icon'] }} text-{{ $kat['color'] }} fs-3"></i>
                        </div>
                        <h5 class="fw-bold mb-1">{{ $kat['nama'] }}</h5>
                        <p class="text-muted small mb-0">{{ $kat['jumlah'] }} Item</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Featured Pets Grid (Hewan Terbaru) -->
    <section>
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold mb-1">Hewan Terbaru</h2>
                <p class="text-muted mb-0">Temukan sahabat baru dari koleksi terbaru kami.</p>
            </div>
            @if($hewan->count() > 3)
            <a class="btn btn-link text-decoration-none" href="{{ route('hewan.index') }}">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
            @endif
        </div>

        @if($hewan->count() > 0)
        <div class="row g-4">
            @foreach($hewan as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift transition-all overflow-hidden">
                    <div class="position-relative" style="height: 200px;">
                        @php
                            $gambarPath = 'storage/' . $item->gambar;
                            $hasImage = $item->gambar && file_exists(public_path($gambarPath));
                        @endphp
                        @if($hasImage)
                            <img src="{{ asset($gambarPath) }}"
                                 class="card-img-top h-100 w-100 object-fit-cover transition-transform hover-zoom"
                                 alt="{{ $item->nama_hewan }}">
                        @else
                            <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                <i class="bi bi-heart-fill text-muted" style="font-size: 4rem;"></i>
                            </div>
                        @endif
                        <span class="position-absolute top-0 start-0 badge bg-warning m-2">
                            {{ $item->jenis ?? 'Hewan' }}
                        </span>
                        <button class="position-absolute top-0 end-0 btn btn-light btn-sm m-2 rounded-circle opacity-75 hover-opacity-100">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title fw-bold mb-0">{{ $item->nama_hewan }}</h5>
                            <span class="text-success fw-bold">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                        </div>
                        <p class="card-text text-muted small text-truncate-2">
                            {{ $item->deskripsi ?? 'Hewan peliharaan sehat dan siap diadopsi' }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <div class="text-muted small">
                                <i class="bi bi-calendar3 me-1"></i>{{ $item->umur ?? '?' }} Bulan
                            </div>
                            <a href="{{ route('hewan.show', $item->id) }}" class="btn btn-primary btn-sm rounded-pill px-3">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5 bg-light rounded-4">
            <i class="bi bi-heart-fill text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3 mb-2">Belum Ada Hewan</h4>
            <p class="text-muted mb-0">Belum ada data hewan peliharaan yang tersedia.</p>
        </div>
        @endif
    </section>
</div>
@endsection

@push('styles')
<style>
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.5;
        min-height: 3em;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
    }
    .hover-zoom:hover {
        transform: scale(1.05);
    }
    .bg-gradient {
        background: linear-gradient(135deg, #198754 0%, #0d6efd 100%);
    }
    .hover-opacity-100:hover {
        opacity: 1 !important;
    }
</style>
@endpush
