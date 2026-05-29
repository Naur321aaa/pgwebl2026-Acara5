<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="fa-solid fa-earth-asia"></i>{{ $title }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav w-100">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('home')}}"><i class="fa-regular fa-heart"></i>Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ route('peta') }}"><i class="fa-solid fa-map-pin"></i>Peta</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ route('tabel') }}"><i class="fa-solid fa-table"></i>Tabel</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('tentang')}}"><i class="fa-solid fa-circle-info"></i>Tentang</a>
            </li>
            {{-- guest digunakan untuk menampilkan menu hanya kepada pengguna yang belum login --}}
            @guest
            <li class="nav-item ms-auto">
            <a class="btn btn-outline-primary rounded-pill px-2" href="{{ route('login') }}">
            <i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
            </li>
            @endguest

            {{-- auth digunakan untuk menampilkan menu hanya kepada pengguna yang sudah login, misalnya tombol logout --}}
            @auth
            <li class="nav-item ms-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger rounded-pill px-2">
                <i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                </form>
            </li>
            @endauth

        </ul>
        </div>
    </div>
    </nav>
