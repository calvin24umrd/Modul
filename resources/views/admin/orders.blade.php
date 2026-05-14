@extends("layouts.app")

@section("title", "Kelola Transaksi - Admin")

@section("content")
<h2>Daftar Transaksi</h2>

<table class="table table-striped mt-3">
    <thead class="table-dark">
        <tr>
            <th>No. Order</th>
            <th>Pembeli</th>
            <th>Total</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
        <tr>
            <td>{{ $order->order_number }}</td>
            <td>{{ $order->user->name }}</td>
            <td>Rp {{ number_format($order->total_amount, 0, ",", ".") }}</td>
            <td>
                <span class="badge bg-{{ $order->status == "delivered" ? "success" : ($order->status == "cancelled" ? "danger" : ($order->status == "paid" ? "info" : ($order->status == "shipped" ? "primary" : "warning"))) }}">
                    {{ ucfirst($order->status) }}
                </span>
            </td>
            <td>{{ $order->created_at->format("d/m/Y H:i") }}</td>
            <td>
                <form action="{{ route("admin.orders.updateStatus", $order->id) }}" method="POST" class="d-flex">
                    @csrf
                    <select name="status" class="form-select form-select-sm" style="width: auto;">
                        <option value="pending" {{ $order->status == "pending" ? "selected" : "" }}>Menunggu</option>
                        <option value="paid" {{ $order->status == "paid" ? "selected" : "" }}>Dibayar</option>
                        <option value="shipped" {{ $order->status == "shipped" ? "selected" : "" }}>Dikirim</option>
                        <option value="delivered" {{ $order->status == "delivered" ? "selected" : "" }}>Selesai</option>
                        <option value="cancelled" {{ $order->status == "cancelled" ? "selected" : "" }}>Batal</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary ms-1">Update</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Tidak ada transaksi</td></tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $orders->links() }}
</div>
@endsection
