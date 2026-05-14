@extends("layouts.app")

@section("title", $product->product_name . " - Cibaduyut Shoes")

@section("content")
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body text-center">
                @if($product->image)
                    <img src="{{ asset($product->image) }}" alt="{{ $product->product_name }}" class="img-fluid rounded">
                @else
                    <div class="bg-secondary text-white p-5 rounded">
                        <i class="bi bi-image" style="font-size: 4rem;"></i>
                        <p>Tidak ada gambar</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <h2>{{ $product->product_name }}</h2>
        <span class="badge bg-info">{{ $product->category->category_name ?? "Tanpa Kategori" }}</span>

        <h3 class="text-danger mt-3">Rp {{ number_format($product->product_price, 0, ",", ".") }}</h3>

        <p class="mt-3">
            <strong>Stok:</strong> 
            @if($product->product_stock > 0)
                <span class="text-success">{{ $product->product_stock }} tersedia</span>
            @else
                <span class="text-danger">Stok Habis</span>
            @endif
        </p>

        @if($product->description)
            <div class="mt-3">
                <h5>Deskripsi</h5>
                <p>{{ $product->description }}</p>
            </div>
        @endif

        <div class="mt-4">
            @auth
                @if(auth()->user()->isUser())
                    @if($product->product_stock > 0)
                        <form action="{{ route("cart.add", $product->product_id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                            </button>
                        </form>
                    @else
                        <button class="btn btn-secondary btn-lg" disabled>Stok Habis</button>
                    @endif
                @else
                    <div class="alert alert-info">
                        Admin tidak bisa membeli produk.
                    </div>
                @endif
            @else
                <a href="{{ route("login") }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-box-arrow-in-right"></i> Login untuk Beli
                </a>
            @endauth

            <a href="{{ route("home") }}" class="btn btn-outline-secondary btn-lg ms-2">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
