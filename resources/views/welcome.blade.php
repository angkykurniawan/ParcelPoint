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
      <h2>Penitipan Surat & Paket</h2>
      <p>Sebuah layanan penitipan surat & paket yang disediakan untuk sivitas akademika Politeknik Caltex Riau</p>

      <div class="search-container">
        <form action="/search-resi" method="GET" class="search-form">
          <input type="text" name="resi" placeholder="Masukkan nomor resi..." class="search-input" required>
          <button type="submit" class="search-button">Search</button>
        </form>
      </div>
    </div>
  </header>
</body>
</html>
