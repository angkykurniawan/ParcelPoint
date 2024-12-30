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
          <div class="cta">
            <a href="/login" class="cta-button">Login</a>
          </div>
        </nav>

        <div class="hero-content">
          <h1>#PenitipanPaketTanpaRibet</h1>
          <h2>Penitipan Paket</h2>
          <p>Sebuah layanan yang disediakan untuk sivitas akademika Politeknik Caltex Riau</p>

          <div class="search-container" id="cekResi">
            <form action="/search-resi" method="GET" class="search-form">
              <input type="text" name="resi" placeholder="Masukkan nomor resi..." class="search-input" required>
              <button type="submit" class="search-button">Search</button>
            </form>
          </div>
        </div>
      </header>

      <!-- Carousel Section -->
      <section class="carousel">
        <div class="carousel-images">
          <img src="https://via.placeholder.com/1200x500/4A90E2/ffffff?text=Image+1" alt="Image 1">
          <img src="https://via.placeholder.com/1200x500/50E3C2/ffffff?text=Image+2" alt="Image 2">
          <img src="https://via.placeholder.com/1200x500/7ED321/ffffff?text=Image+3" alt="Image 3">
        </div>
        <div class="carousel-buttons">
          <button class="carousel-button prev" onclick="moveSlide(-1)">&#10094;</button>
          <button class="carousel-button next" onclick="moveSlide(1)">&#10095;</button>
        </div>
      </section>

      <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-images img');

        function moveSlide(step) {
          currentSlide += step;
          if (currentSlide < 0) {
            currentSlide = slides.length - 1;
          } else if (currentSlide >= slides.length) {
            currentSlide = 0;
          }
          updateCarousel();
        }

        function updateCarousel() {
          const carouselImages = document.querySelector('.carousel-images');
          carouselImages.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        // Auto move slides every 5 seconds
        setInterval(() => moveSlide(1), 5000);
      </script>
</body>
</html>
