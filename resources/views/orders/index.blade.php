@extends("layouts.app")

@section("title", "Riwayat Pesanan - Cibaduyut Shoes")

@section("content")
<h2>Riwayat Pesanan</h2>

@if($orders->isEmpty())
    <div class="alert alert-info">
        Belum ada pesanan. <a href="{{ route("home") }}">Mulai belanja</a>
    </div>
@else
    <table class="table table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>No. Order</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Jumlah Item</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td><strong>{{ $order->order_number }}</strong></td>
                <td>{{ $order->created_at->format("d/m/Y H:i") }}</td>
                <td>Rp {{ number_format($order->total_amount, 0, ",", ".") }}</td>
                <td>{{ $order->items->count() }} item</td>
                <td>
                    @switch($order->status)
                        @case("pending") <span class="badge bg-warning">Menunggu</span> @break
                        @case("paid") <span class="badge bg-info">Dibayar</span> @break
                        @case("shipped") <span class="badge bg-primary">Dikirim</span> @break
                        @case("delivered") <span class="badge bg-success">Selesai</span> @break
                        @case("cancelled") <span class="badge bg-danger">Dibatalkan</span> @break
                    @endswitch
                </td>
                <td><a href="{{ route("orders.show", $order->id) }}" class="btn btn-sm btn-primary">Detail</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $orders->links() }}
    </div>
@endif
@endsection
