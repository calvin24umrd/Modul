@extends("layouts.app")

@section("title", "Cibaduyut Shoes")

@section("content")
<section class="hero-section text-white">
    <div class="container text-center">
        <h2>Sistem Manajemen Sepatu</h2>
        <p class="lead mb-4">Sepatu impian dari koleksi eksklusif</p>
    </div>
</section>

<div class="container my-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Daftar Sepatu</h3>
        <form action="{{ route("home") }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..." value="{{ request("search") }}">
            <button type="submit" class="btn btn-outline-light">Cari</button>
        </form>
    </div>

    @if(isset($products) && $products->isNotEmpty())
        <div class="row g-4">
            @foreach($products as $product)
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <span class="badge bg-secondary mb-2">{{ $product->category->category_name ?? "Tanpa Kategori" }}</span>
                        <p class="text-danger fw-bold">Rp {{ number_format($product->product_price, 0, ",", ".") }}</p>
                        <p class="text-muted">Stok: {{ $product->product_stock }}</p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route("products.show", $product->product_id) }}" class="btn btn-primary w-100 mb-2">Detail</a>
                        @auth
                            @if(auth()->user()->isUser() && $product->product_stock > 0)
                                <form action="{{ route("cart.add", $product->product_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger w-100">+ Keranjang</button>
                                </form>
                            @elseif($product->product_stock <= 0)
                                <button class="btn btn-secondary w-100" disabled>Stok Habis</button>
                            @endif
                        @else
                            <a href="{{ route("login") }}" class="btn btn-outline-danger w-100">Login untuk Beli</a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">Tidak ada produk ditemukan.</div>
    @endif
</div>
@endsection
