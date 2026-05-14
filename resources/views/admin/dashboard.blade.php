@extends("layouts.app")

@section("title", "Admin Dashboard - Cibaduyut Shoes")

@section("content")
<h2>Admin Dashboard</h2>
<p class="text-muted">Selamat datang, {{ auth()->user()->name }}!</p>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <h1>{{ $stats["totalProducts"] }}</h1>
                <p>Total Produk</p>
                <a href="{{ route("admin.products") }}" class="btn btn-light btn-sm">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <h1>{{ $stats["totalUsers"] }}</h1>
                <p>Total Pembeli</p>
                <a href="{{ route("admin.users") }}" class="btn btn-light btn-sm">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                <h1>{{ $stats["totalOrders"] }}</h1>
                <p>Total Transaksi</p>
                <a href="{{ route("admin.orders") }}" class="btn btn-light btn-sm">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body text-center">
                <h1>Rp {{ number_format($stats["totalRevenue"], 0, ",", ".") }}</h1>
                <p>Total Pendapatan</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <h4>Transaksi Terbaru</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No. Order</th>
                    <th>Pembeli</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>Rp {{ number_format($order->total_amount, 0, ",", ".") }}</td>
                    <td><span class="badge bg-{{ $order->status == "delivered" ? "success" : ($order->status == "cancelled" ? "danger" : "warning") }}">{{ ucfirst($order->status) }}</span></td>
                    <td>{{ $order->created_at->format("d/m/Y") }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">Belum ada transaksi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
