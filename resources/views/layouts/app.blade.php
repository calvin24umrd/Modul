<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title", "Cibaduyut Shoes")</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
</head>
<body>
    @php
        $isAdmin = auth()->check() && auth()->user()->isAdmin();
        $isUser = auth()->check() && auth()->user()->isUser();
    @endphp

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url("/") }}">CIBADUYUT SHOES</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                @if(!auth()->check())
                    <a href="{{ route("login") }}" class="btn btn-outline-primary btn-sm me-2">Login</a>
                    <a href="{{ route("register") }}" class="btn btn-outline-success btn-sm">Register</a>
                @elseif($isAdmin)
                    <span class="navbar-text text-white me-3">Admin: {{ auth()->user()->name }}</span>
                    <a href="{{ route("admin.dashboard") }}" class="btn btn-outline-info btn-sm me-2">Dashboard</a>
                    <form action="{{ route("logout") }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                    </form>
                @else
                    <span class="navbar-text text-white me-2">Halo, {{ auth()->user()->name }}!</span>
                    <a href="{{ route("cart") }}" class="btn btn-outline-warning btn-sm me-2">
                        Cart <span id="cart-count"></span>
                    </a>
                    <a href="{{ route("orders") }}" class="btn btn-outline-info btn-sm me-2">Pesanan</a>
                    <a href="{{ route("profile") }}" class="btn btn-outline-light btn-sm me-2">Profil</a>
                    <form action="{{ route("logout") }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                    </form>
                @endif
            </div>
        </div>
    </nav>

    <main class="container my-4">
        @if(session("success"))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session("success") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session("error"))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session("error") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield("content")
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <small>© 2026 Cibaduyut Shoes</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset("js/script.js") }}"></script>
</body>
</html>
