<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} || Hasil Pencarian</title>
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
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: white;
            z-index: 1000;
            padding: 20px 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Hero Section */
        header.hero {
            background-color: #ffffff;
            padding: 100px 0 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .hero-content {
            text-align: center;
        }

        h1 {
            font-size: 2.8rem;
            color: #3475FE;
            font-weight: bolder;
            margin-bottom: 10px;
        }

        h1 + hr {
            width: 300px;
            border: 2px solid #3475FE;
            margin: 0 auto;
            margin-bottom: 30px;
        }

        /* Card Styling for Each Result */
        .resi-card {
            display: inline-block;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 400px;
            margin: 30px auto;
            text-align: left;
        }

        .resi-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .resi-info p {
            font-size: 1.2rem;
            line-height: 1.8;
            margin: 12px 0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background: #f9f9f9;
            display: flex;
            justify-content: space-between; /* Align label and value to the sides */
        }

        .resi-info p:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .resi-info strong {
            color: #3475FE;
            font-size: 1.4rem;
            font-weight: bold;
        }

        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 1rem;
        }

        /* Button Container */
        .button-container {
            display: flex;
            justify-content: center; /* Center the buttons horizontally */
            margin-top: 20px;
        }

        .button {
            padding: 15px 30px; /* Increased padding */
            font-size: 1.4rem; /* Increased font size */
            color: white;
            background-color: #3475FE;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 10px; /* Add space between buttons */
        }

        .button a {
            color: white;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .resi-card {
                width: 90%;
                padding: 20px;
            }

            .button {
                font-size: 1.2rem; /* Adjusted font size for smaller screens */
                padding: 12px 25px; /* Adjusted padding for smaller screens */
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

    <div class="hero-content" style="margin-top: 200px;">
        <h1>Hasil Pencarian Surat & Paket Pemilik</h1>
        <hr>

        @if($suratPaket->isEmpty())
            <div class="alert">No results found.</div>
        @else
            @foreach($suratPaket as $item)
                <div class="resi-card">
                    <div class="resi-info">
                        <p><strong>Jenis:</strong> <span>{{ $item->Jenis }}</span></p>
                        <p><strong>Resi:</strong> <span>{{ $item->Resi }}</span></p>
                        <p><strong>Pemilik:</strong> <span>{{ $item->Pemilik->Nama ?? 'Nama Pemilik Tidak Ditemukan' }}</span></p>
                        <p><strong>Waktu Antar:</strong> <span>{{ $item->created_at }}</span></p>
                        <p><strong>Status:</strong> <span>{{ $item->status_daftar }}</span></p>
                        <p><strong>Waktu Jemput:</strong> <span>
                            @if($item->WaktuJemput)
                                {{ \Carbon\Carbon::parse($item->WaktuJemput)->format('d-m-Y H:i') }}
                            @else
                                -
                            @endif
                        </span></p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</header>

</body>
</html>
