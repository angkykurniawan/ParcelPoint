<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ env('APP_NAME') }} || Cek Resi</title>
  <link rel="shortcut icon" href="{{ url('Crovex/HTML/assets/images/ParcelPointLogoOnly.png') }}">
  <link rel="stylesheet" href="css/welcomeCSS.css">

  <style>
    /* General body and font settings */
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f7fb;
      margin: 0;
      padding: 0;
      color: #3475FE; /* Default text color is blue */
    }

    /* Navbar */
    .navbar {
      position: fixed; /* Make the navbar fixed at the top */
      top: 0;
      left: 0;
      right: 0;
      background-color: white; /* Ensure the navbar has a background */
      z-index: 1000; /* Keep the navbar on top of other elements */
      padding: 20px 0; /* Adjust padding for better spacing */
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Add shadow to navbar */
    }

    /* Adjust the space for the hero section to avoid overlapping with navbar */
    header.hero {
      background-color: #ffffff;
      padding: 100px 0 40px; /* Add padding to the top to prevent overlap */
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .hero-content {
      text-align: center;
    }

    h1 {
      font-size: 2.8rem;
      color: #3475FE; /* Dark Blue for the title */
      font-weight: bolder; /* Make the title bold */
      margin-bottom: 10px; /* Space between title and line */
    }

    /* Blue line under the title */
    h1 + hr {
      width: 300px; /* Adjust the width to match the length of the title */
      border: 2px solid #3475FE; /* Dark Blue color for the line */
      margin: 0 auto; /* Center the line */
      margin-bottom: 30px; /* Add space after the line */
    }

    /* Result card styling */
    .resi-card {
      display: inline-block;
      padding: 30px; /* Add more padding for extra space inside the card */
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      max-width: 900px; /* Make the card wider */
      width: 400px; /* Adjust the width based on content */
      margin: 30px auto; /* Center the card */
      text-align: left; /* Center content vertically */
      position: relative;
    }

    .resi-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    /* Styling for each info section inside the card */
    .resi-info p {
      font-size: 1.2rem;
      line-height: 1.8;
      margin: 12px 0;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      background: #f9f9f9;
    }

    .resi-info p:hover {
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Styling for column titles */
    .resi-info strong {
      color: 3475FE; /* Dark Blue for title */
      font-size: 1.4rem; /* Bigger font size for column titles */
      font-weight: bold;
    }

    /* Alert box */
    .alert {
      background-color: #f8d7da;
      color: #721c24;
      padding: 15px;
      border-radius: 5px;
      margin-top: 20px;
      font-size: 1rem;
    }

    /* Buttons container at the bottom */
    .buttons-container {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    /* Button style */
    .button {
      padding: 10px 20px;
      font-size: 1rem;
      color: white;
      background-color: #3475FE; /* Blue button color */
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 48%; /* Ensure buttons take equal space */
    }

    /* Links inside buttons */
    .button a {
      color: white; /* Ensure the link text in buttons is also white */
      text-decoration: none;
    }

    /* Responsive styling */
    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 2.2rem;
      }

      .resi-card {
        width: 90%; /* Use full width for smaller screens */
        padding: 20px;
      }

      .button {
        font-size: 0.9rem; /* Smaller buttons on mobile */
        padding: 8px 16px;
      }
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
      <div class="cta">
        @auth
          <a href="/dashboard" class="cta-button">Dashboard {{ strtoupper(Auth::user()->name) }}</a>
        @else
          <a href="/login" class="cta-button">Login</a>
        @endauth
      </div>
    </nav>

    <div class="hero-content">
      <h1 style="color: #3475FE; font-weight: bolder;">Hasil Pencarian Resi</h1>
      <hr> <!-- Blue line under the title -->
      @if(session('error'))
        <div class="alert">{{ session('error') }}</div>
      @else
        <div class="resi-card">
          <div class="resi-info">
            <p style="display: flex; justify-content: space-between; color: #3475FE;">
              <strong>Resi:</strong><span style="color: #000;">{{ $resi->resi }}</span>
            </p>
            <p style="display: flex; justify-content: space-between; color: #3475FE;">
              <strong>Jenis:</strong><span style="color: #000;">{{ $resi->jenis }}</span>
            </p>
            <p style="display: flex; justify-content: space-between; color: #3475FE;">
              <strong>Pemilik:</strong><span style="color: #000;">{{ $resi->pemilik }}</span>
            </p>
            <p style="display: flex; justify-content: space-between; color: #3475FE;">
              <strong>Waktu Antar:</strong><span style="color: #000;">{{ $resi->created_at }}</span>
            </p>
            <p style="display: flex; justify-content: space-between; color: #3475FE;">
              <strong>Status:</strong><span style="color: #000;">{{ $resi->status_daftar }}</span>
            </p>
            <p style="display: flex; justify-content: space-between; color: #3475FE;">
              <strong>Waktu Jemput:</strong>
              <span style="color: #000;">
                @if($resi->WaktuJemput)
                    {{ \Carbon\Carbon::parse($resi->WaktuJemput)->format('d-m-Y H:i') }}
                @else
                    -
                @endif
              </span>
            </p>
          </div>

          <!-- Buttons Container (Positioned Below the Content) -->
          <div class="buttons-container">
            <!-- Tombol Kembali -->
            <button class="button" onclick="window.history.back()">Kembali</button>

            <!-- Tombol Login -->
            <button class="button">
              @auth
                Dashboard {{ strtoupper(Auth::user()->name) }}
              @else
                <a href="/login">Login</a>
              @endauth
            </button>
          </div>
        </div>
      @endif
    </div>
  </header>
</body>
</html>
