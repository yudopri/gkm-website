<nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
    <a href="{{ url('/') }}" class="navbar-brand p-0">
        <h1 class="m-0">GKM POLIJE</h1>
        <!-- <img src="img/logo.png" alt="Logo"> -->
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{ url('/') }}" class="nav-item nav-link">Beranda</a>
            <a href="{{ url('/informasi')}}" class="nav-item nav-link">Informasi</a>
        </div>
        <a href="{{ route('login') }}" class="btn btn-light rounded-pill text-primary py-2 px-4 ms-lg-5">Login</a>
    </div>
</nav>
