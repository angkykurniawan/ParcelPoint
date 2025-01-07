<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ env('APP_NAME') }}</title>
  <link rel="stylesheet" href="css/welcomeCSS.css">
  <link rel="shortcut icon" href="{{ url('Crovex/HTML/assets/images/ParcelPointLogoOnly.png') }}">

  <style>
    /* Gambar animasi */
    .animated-image {
      width: 100%; /* Gambar mengambil lebar penuh */
      height: 200px; /* Atur tinggi gambar animasi */
      object-fit: contain; /* Agar gambar tidak terpotong */
      animation: move 2s ease-in-out infinite;
    }

    /* Media Query untuk perangkat dengan layar lebih kecil */
    @media (max-width: 768px) {
      .carousel {
        height: 25vh; /* Mengurangi tinggi lebih lanjut untuk perangkat dengan layar lebih kecil */
      }

      .animated-image {
        height: 150px; /* Mengatur tinggi gambar animasi lebih kecil di layar kecil */
      }
    }


    /* Gambar dengan efek shadow putih */
.animated-image {
  width: 100%; /* Mengambil lebar penuh */
  height: 100px; /* Atur tinggi sesuai kebutuhan */
  object-fit: contain; /* Agar gambar tidak terpotong */
  animation: move 2s ease-in-out infinite;
  box-shadow: 0 0 15px 5px rgba(255, 255, 255, 0.8); /* Shadow putih */
}
  </style>
</head>
<body>
  <header class="hero">
    <nav class="navbar">
      <div class="logo">
        <img src="{{ url('Crovex/HTML/assets/images/ParcelPointWithText.png') }}" alt="Logo ParcelPoint" class="logo-img">
      </div>
      <ul class="nav-links">
        <li><a href="https://pcr.ac.id" target="_blank">Politeknik Caltex Riau</a></li>
        <li><a href="https://portal.pcr.ac.id" target="_blank">Layanan Lainnya</a></li>
      </ul>

      <!-- Cek apakah user sudah login -->
      @if(Auth::check())
        <div class="user-info">
          <a href="/dashboard" class="cta-button">Dashboard {{ strtoupper(Auth::user()->name) }}</a>
        </div>
      @else
        <div class="cta">
          <a href="/login" class="cta-button">Login</a>
        </div>
      @endif
    </nav>
    <br><br>

    <div class="hero-content">
      <!-- Carousel -->
      <br><br>

      <!-- Gambar bergerak -->
      <img src="{{ url('Crovex/HTML/assets/images/logoPCR.png') }}" alt="Gambar Bergerak" class="animated-image">
      <br><br><br><br><br><br><br>
      <h1>#PenitipanPaketTanpaRibet</h1>
      <h2>Penitipan Surat & Paket</h2>
      <p>Sebuah layanan penitipan surat & paket yang disediakan untuk sivitas akademika Politeknik Caltex Riau</p>

      <!-- Cari Berdasarkan Cek Resi -->
      <div class="search-container">
        <form action="{{ route('search.resi') }}" method="GET" class="search-form">
          <input type="text" name="resi" placeholder="Masukkan nomor resi..." class="search-input" required>
          <button type="submit" class="search-button">Search</button>
        </form><br><br><br><br><br>
        @if (session('error'))
        <div class="error-message">
          {{ session('error') }}
        </div>
      @endif
      </div>

      <div class="search-container">
        <form action="{{ route('searchOwner') }}" method="GET" class="search-form">
            <input type="text" name="owner" placeholder="Masukkan nama pemilik..." class="search-input" required>
            <button type="submit" class="search-button">Search</button>
        </form>
        </div>
      </div>
    </div>
  </header>
</body>
</html>
