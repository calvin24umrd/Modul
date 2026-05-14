@extends("layouts.app")

@section("title", "Detail Pesanan - Cibaduyut Shoes")

@section("content")
<div class="row">
    <div class="col-md-12">
        <a href="{{ route("orders") }}" class="btn btn-secondary mb-3">← Kembali</a>
    </div>
</div>

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Detail Pesanan #{{ $order->order_number }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Tanggal:</strong> {{ $order->created_at->format("d/m/Y H:i") }}</p>
                <p><strong>Status:</strong>
                    @switch($order->status)
                        @case("pending") <span class="badge bg-warning">Menunggu Pembayaran</span> @break
                        @case("paid") <span class="badge bg-info">Sudah Dibayar</span> @break
                        @case("shipped") <span class="badge bg-primary">Sedang Dikirim</span> @break
                        @case("delivered") <span class="badge bg-success">Selesai</span> @break
                        @case("cancelled") <span class="badge bg-danger">Dibatalkan</span> @break
                    @endswitch
                </p>
                <p><strong>Alamat Pengiriman:</strong><br>{{ $order->shipping_address }}</p>
            </div>
            <div class="col-md-6 text-end">
                <h3>Total: <span class="text-danger">Rp {{ number_format($order->total_amount, 0, ",", ".") }}</span></h3>
            </div>
        </div>

        <hr>

        <h5>Item Pesanan</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->product_name ?? "Produk Dihapus" }}</td>
                    <td>Rp {{ number_format($item->price, 0, ",", ".") }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price * $item->quantity, 0, ",", ".") }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Total:</th>
                    <th>Rp {{ number_format($order->total_amount, 0, ",", ".") }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
