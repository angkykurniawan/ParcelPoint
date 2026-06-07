<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} | Konfirmasi Keamanan</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{ url('Crovex/HTML/assets/images/ParcelPointLogoOnly.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f0f7ff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        /* Kartu Konfirmasi */
        .main-confirm-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.08);
            border: 1px solid #e1eeff;
            padding: 2rem;
            width: 100%;
            max-width: 480px; /* Dikunci agar proporsional di desktop, fleksibel di HP */
        }

        .icon-box {
            background-color: #f0f7ff;
            color: #0d6efd;
            padding: 12px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Desain Form Modern yang Selaras dengan Halaman Login */
        .form-control {
            border: 2px solid #cbdfff;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
            border-color: #0d6efd;
        }

        .btn-primary {
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="main-confirm-card">

        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="icon-box">
                <i class="bi bi-shield-lock-fill fs-4"></i>
            </div>
            <div class="text-start">
                <h5 class="fw-bold text-dark m-0">Konfirmasi Keamanan</h5>
                <p class="text-muted small m-0">Area ini dilindungi enkripsi sistem</p>
            </div>
        </div>

        <div class="alert alert-info border-0 text-start small mb-4 rounded-3 p-3" style="background-color: #f0f7ff; color: #084298; line-height: 1.5;">
            {{ __('Ini adalah area aman aplikasi. Silakan masukkan dan konfirmasi password Anda saat ini sebelum melanjutkan ke halaman berikutnya.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="mb-4 text-start">
                <label for="password" class="form-label text-secondary small fw-bold text-uppercase tracking-wider">Password Akun</label>
                <input id="password"
                       type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Masukkan password Anda..."
                       required
                       autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-md-end">
                <button type="submit" class="btn btn-primary shadow-sm w-100 w-md-auto">
                    {{ __('Konfirmasi Password') }}
                </button>
            </div>
        </form>

    </div>

</body>
</html>
