@extends("layouts.app")

@section("title", "Kelola User - Admin")

@section("content")
<h2>Daftar Pembeli</h2>

<table class="table table-striped mt-3">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
            <th>Terdaftar</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->no_telepon ?? "-" }}</td>
            <td>{{ Str::limit($user->alamat, 30) ?? "-" }}</td>
            <td>{{ $user->created_at->format("d/m/Y") }}</td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Tidak ada pembeli</td></tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $users->links() }}
</div>
@endsection
