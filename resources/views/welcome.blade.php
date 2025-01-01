<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ env('APP_NAME') }}</title>
  <link rel="stylesheet" href="css/welcomeCSS.css">
  <link rel="shortcut icon" href="{{ url('Crovex/HTML/assets/images/ParcelPointLogoOnly.png') }}">
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

    <div class="hero-content">
      <!-- Carousel -->
      <div class="carousel">
        <div class="carousel-images">
          <img src="{{ url('Crovex/HTML/assets/images/bg1.png') }}" alt="Image 1">
          <img src="{{ url('Crovex/HTML/assets/images/bg2.png') }}" alt="Image 2">
        </div>
      </div><br>

      <!-- Gambar bergerak -->
      <img src="{{ url('Crovex/HTML/assets/images/ParcelPointWithText.png') }}" alt="Gambar Bergerak" class="animated-image">

      <h1>#PenitipanPaketTanpaRibet</h1>
      <h2>Penitipan Surat & Paket</h2>
      <p>Sebuah layanan penitipan surat & paket yang disediakan untuk sivitas akademika Politeknik Caltex Riau</p>
      <div class="search-container">
        <form action="{{ route('search.resi') }}" method="GET" class="search-form">
            <input type="text" name="resi" placeholder="Masukkan nomor resi..." class="search-input" required>
            <button type="submit" class="search-button">Search</button>
        </form>
      </div>
    </div>
  </header>

  <script>
    let currentIndex = 0;
    const images = document.querySelector('.carousel-images');
    const totalImages = images.children.length;

    function moveCarousel() {
      // Menentukan gambar yang aktif
      currentIndex = (currentIndex + 1) % totalImages;
      const offset = -currentIndex * 100; // Offset pergeseran gambar
      images.style.transform = `translateX(${offset}%)`;
    }

    // Menggerakkan carousel otomatis setiap 10 detik
    setInterval(moveCarousel, 5000); // Interval 10 detik
  </script>
</body>
</html>
