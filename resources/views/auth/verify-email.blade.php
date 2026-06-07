<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} | Verify Email</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{ url('Crovex/HTML/assets/images/ParcelPointLogoOnly.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.6/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            padding: 1rem;
        }
        .login-card {
            display: flex;
            flex-direction: column;
            width: 100%;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.06);
            border: 1px solid #e1eeff;
        }
        .login-image {
            width: 100%;
            height: 220px;
            background: url('/images/Kurir_LoginPage.png') no-repeat center center;
            background-size: contain;
            background-position: center center;
            object-fit: contain;
            background-color: #f8faff;
        }
        .login-form {
            width: 100%;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-form h3 {
            font-size: 1.75rem;
            margin-bottom: 15px;
            font-weight: 600;
            color: #333;
        }
        @media (min-width: 768px) {
            .login-card {
                flex-direction: row;
                max-width: 900px;
                height: auto;
            }
            .login-image {
                flex: 0 0 65%;
                min-height: 520px;
            }
            .login-form {
                flex: 0 0 35%;
                padding: 40px;
            }
        }
        .btn-primary {
            border-radius: 12px;
            padding: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <div class="login-image"></div>
            <div class="login-form">
                <div class="text-center mb-3">
                    <img src="{{ url('Crovex/HTML/assets/images/ParcelPointWithText.png') }}" alt="ParcelPoint" class="img-fluid" style="max-width: 220px; height: auto;">
                </div>
                <h3 class="text-primary text-center" style="font-weight: bolder;">Verifikasi Email</h3>

                <div class="mb-4 text-secondary text-center small" style="line-height: 1.6;">
                    {{ __('Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan melalui email kepada Anda? Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan email lainnya kepada Anda.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success border-0 small rounded-3 mb-4 text-center">
                        {{ __('Link Verifikasi Email Baru telah dikirimkan ke email.') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100 shadow-sm">Kirim ulang link verifikasi</button>
                </form>

                <div class="text-center mt-4 small">
                    <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.6/dist/sweetalert2.all.min.js"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Sukses!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-primary px-4'
                },
                buttonsStyling: false
            });
        @endif
    </script>
</body>
</html>
