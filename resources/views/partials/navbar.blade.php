<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">Fasilitas Kota</a>
        <div class="navbar-nav">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            <a href="{{ route('profil') }}" class="nav-link">Profil</a>
            <a href="{{ route('reports.index') }}" class="nav-link">Reports</a>
        </div>
    </div>

    @guest
        <a href="{{ route('login') }}" class="btn btn-primary btn-sm me-5">Log In</a>
    @endguest

    @auth
        <span class="me-3">Halo, {{ auth()->user()->name }}</span>

        @if (auth()->user()->role === 'admin')
            <a href="{{ route('admin.kategori.index') }}" class="me-3">
                Kelola Kategori
            </a>
        @endif

        <a href="{{ route('reports.index') }}" class="me-3">Laporan</a>

        <form method="POST" class="d-inline" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-danger btn-sm">Log Out</button>
        </form>
    @endauth

</nav>
