<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">PetShop Market</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">

                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </li>
                @endguest

                @auth

                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('hewan.index') }}" class="nav-link">Data Hewan</a>
                    </li>

                    <li class="nav-item">
                        <span class="nav-link text-warning">
                            {{ Auth::user()->name }}
                        </span>
                    </li>

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm mt-1">
                                Logout
                            </button>
                        </form>
                    </li>

                @endauth

            </ul>
        </div>
    </div>
</nav>