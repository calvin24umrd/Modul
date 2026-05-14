@extends("layouts.app")

@section("title", "Kelola Produk - Admin")

@section("content")
<h2>Kelola Produk</h2>
<p class="text-muted">Halaman ini hanya untuk melihat produk. Admin tidak dapat menambahkan, mengedit, atau menghapus produk.</p>

<div class="alert alert-info">
    <strong>Info:</strong> Anda adalah admin. Untuk fitur tambah/edit/hapus produk, hubungi developer.
</div>

<table class="table table-striped mt-3">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <td>{{ $product->product_id }}</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->category->category_name ?? "-" }}</td>
            <td>Rp {{ number_format($product->product_price, 0, ",", ".") }}</td>
            <td>{{ $product->product_stock }}</td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center">Tidak ada produk</td></tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $products->links() }}
</div>
@endsection
