<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm sticky-top">
  <div class="container">
    <img src="{{ asset('storage/logokab.svg') }}" alt="" width="60" height="70" class="mx-3"/>
    <a class="navbar-brand" href="#">Desa Tumpakrejo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ $active === "home" ? 'active' : '' }}" aria-current="page" href="/">Beranda</a>
        </li>
        <li class="nav-item">
          {{-- <a class="nav-link {{ $active === "about" ? 'active' : '' }}" href="/about">Profil</a> --}}
          <div class="dropdown color-danger">
            <button class="nav-link btn btn-danger dropdown-toggle {{ $active === "about" ? 'active' : '' }}" type="button" data-bs-toggle="dropdown" >
              Tentang Desa
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/about">Profil Desa</a></li>
              <li><a class="dropdown-item" href="/visi-misi">Visi & Misi</a></li>
              <li><a class="dropdown-item" href="/aparatur">Aparatur Desa</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $active === "berita" ? 'active' : '' }}" href="/berita">Berita</a>
        </li>
        <li class="nav-item">
          {{-- <a class="nav-link {{ $active === "categories" ? 'active' : '' }}" href="/categories">Categories</a> --}}
          <div class="dropdown color-danger">
            <button class="nav-link btn btn-danger dropdown-toggle {{ $active === "artikel" ? 'active' : '' }}" type="button" data-bs-toggle="dropdown" >
              Artikel
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/potensi">Potensi Desa</a></li>
              <li><a class="dropdown-item" href="/produk">Produk Unggulan</a></li>
              <li><a class="dropdown-item" href="/program">Program Desa</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $active === "galeri" ? 'active' : '' }}" href="/galeri">Galeri</a>
        </li>
      </ul>
    </div>
  </div>
</nav>