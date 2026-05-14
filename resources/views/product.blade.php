<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cibaduyut SHOES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">CIBADUYUT SHOES</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            @if(!session()->has('user'))
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2">Login</a>
            @else
                <span class="navbar-text me-2 text-white">Halo, {{ session('user') }}!</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">@csrf<button type="submit" class="btn btn-outline-danger btn-sm">Logout</button></form>
            @endif
            <button class="btn btn-outline-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#wishlistModal" onclick="tampilkanWishlist()">
                ⭐ Wishlist (<span id="wishlist-count">0</span>)
            </button>
            <button id="btn-theme" class="btn btn-outline-light btn-sm">Mode Gelap</button>
        </div>
    </div>
</nav>

<section class="hero text-white">
    <div class="container text-center">
        <h2>Sistem Manajemen Sepatu</h2>
        <p class="lead mb-4">Sepatu impian dari koleksi eksklusif</p>
    </div>
</section>

<div class="container my-4">
    <div class="row text-center mb-4">
        <div class="col-md-4"><div class="card shadow-sm"><div class="card-body"><h6 class="text-muted">Total Produk</h6><h3>12</h3></div></div></div>
        <div class="col-md-4"><div class="card shadow-sm"><div class="card-body"><h6 class="text-muted">Stok Tersedia</h6><h3>85</h3></div></div></div>
        <div class="col-md-4"><div class="card shadow-sm"><div class="card-body"><h6 class="text-muted">Kategori</h6><h3>3</h3></div></div></div>
    </div>

    <div class="d-flex justify-content-between mb-3">
        <h3 class="mb-4">Daftar Sepatu</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">Tambah Produk</button>
    </div>

    <div class="row" id="container-barang">
        @foreach ($products as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title mt-2">{{ $item->product_name }}</h5>
                        <span class="badge bg-secondary mb-2">{{ $item->category->category_name }}</span>
                        <p class="card-text text-danger">
                            Rp {{ number_format($item->product_price, 0, ',', '.') }}
                        </p>
                        <p class="card-text">Stok: {{ $item->product_stock }} </p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-detail w-50 me-2">Beli</button>
                            <button class="btn btn-outline-danger btn-wishlist w-50">❤️ Wishlist</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="modal fade" id="tambahProdukModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahProdukModalLabel">Tambah Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="product_price" class="form-label">Harga Produk</label>
                        <input type="number" class="form-control" id="product_price" name="product_price" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_stock" class="form-label">Stok Produk</label>
                        <input type="number" class="form-control" id="product_stock" name="product_stock" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-auto border-top">
    <small>© 2026 Cibaduyut Shoes</small>
</footer>

<div class="modal fade" id="wishlistModal" tabindex="-1" aria-labelledby="wishlistModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wishlistModalLabel">Wishlist Kamu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="empty-wishlist" class="text-center text-muted d-none">Wishlist kosong.</div>
                <ul id="wishlist-list" class="list-group"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" id="clear-wishlist" class="btn btn-outline-danger">Hapus Semua</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

