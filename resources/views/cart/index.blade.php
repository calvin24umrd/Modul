@extends("layouts.app")

@section("title", "Keranjang - Cibaduyut Shoes")

@section("content")
<h2>Keranjang Belanja</h2>

@if($carts->isEmpty())
    <div class="alert alert-info">
        Keranjang kosong. <a href="{{ route("home") }}">Lanjut belanja</a>
    </div>
@else
    <div class="row">
        <div class="col-md-8">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                    <tr>
                        <td>
                            <strong>{{ $cart->product->product_name }}</strong>
                            <br><small class="text-muted">Stok: {{ $cart->product->product_stock }}</small>
                        </td>
                        <td>Rp {{ number_format($cart->product->product_price, 0, ",", ".") }}</td>
                        <td>
                            <form action="{{ route("cart.update", $cart->id) }}" method="POST" class="d-flex">
                                @csrf
                                <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" max="{{ $cart->product->product_stock }}" class="form-control" style="width: 70px;">
                                <button type="submit" class="btn btn-sm btn-primary ms-1">Update</button>
                            </form>
                        </td>
                        <td><strong>Rp {{ number_format($cart->product->product_price * $cart->quantity, 0, ",", ".") }}</strong></td>
                        <td>
                            <form action="{{ route("cart.remove", $cart->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm("Yakin?")">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Ringkasan Belanja</h5>
                </div>
                <div class="card-body">
                    <h4>Total: <span class="text-danger">Rp {{ number_format($total, 0, ",", ".") }}</span></h4>
                    <hr>
                    <form action="{{ route("checkout") }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Alamat Pengiriman</label>
                            <textarea class="form-control" rows="3" disabled>{{ auth()->user()->alamat }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100 btn-lg">Checkout</button>
                    </form>
                    <a href="{{ route("home") }}" class="btn btn-outline-secondary w-100 mt-2">Lanjut Belanja</a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
