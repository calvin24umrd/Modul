@extends("layouts.app")

@section("title", "Dashboard - Cibaduyut Shoes")

@section("content")
<div class="row">
    <div class="col-md-12">
        <h2>Dashboard</h2>
        <p class="text-muted">Selamat datang, {{ $user->name }}!</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Profil Saya</h5>
                <p class="card-text">{{ $user->name }}</p>
                <p class="text-muted small">{{ $user->email }}</p>
                <a href="{{ route("profile") }}" class="btn btn-primary btn-sm">Edit Profil</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Keranjang</h5>
                <p class="card-text">Kelola belanjaan Anda</p>
                <a href="{{ route("cart") }}" class="btn btn-warning btn-sm">Lihat Keranjang</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Pesanan Saya</h5>
                <p class="card-text">Lihat riwayat pesanan</p>
                <a href="{{ route("orders") }}" class="btn btn-info btn-sm">Riwayat Pesanan</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <h4>Pesanan Terbaru</h4>
        @if($orders->isEmpty())
            <div class="alert alert-info">Belum ada pesanan. <a href="{{ route("home") }}">Mulai belanja</a></div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No. Order</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->created_at->format("d/m/Y H:i") }}</td>
                        <td>Rp {{ number_format($order->total_amount, 0, ",", ".") }}</td>
                        <td>
                            @switch($order->status)
                                @case("pending") <span class="badge bg-warning">Menunggu</span> @break
                                @case("paid") <span class="badge bg-info">Dibayar</span> @break
                                @case("shipped") <span class="badge bg-primary">Dikirim</span> @break
                                @case("delivered") <span class="badge bg-success">Selesai</span> @break
                                @case("cancelled") <span class="badge bg-danger">Dibatalkan</span> @break
                            @endswitch
                        </td>
                        <td><a href="{{ route("orders.show", $order->id) }}" class="btn btn-sm btn-outline-primary">Detail</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
