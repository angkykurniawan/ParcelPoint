<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} | Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{ url('Crovex/HTML/assets/images/ParcelPointLogoOnly.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
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
            margin-bottom: 20px;
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
                min-height: 580px;
            }
            .login-form {
                flex: 0 0 35%;
                padding: 40px;
            }
        }
        .form-control {
            border: 2px solid #0d6efd;
            border-radius: 12px;
            padding: 12px 16px;
        }
        .form-control:focus {
            box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
            border-color: #0d6efd;
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
                <h3 class="text-primary text-center" style="font-weight: bolder;">Pendaftaran Akun Baru</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3 text-start">
                        <label for="name" class="form-label text-primary fw-bold small">Nama Lengkap</label>
                        <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan nama lengkap..." required autofocus autocomplete="name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="email" class="form-label text-primary fw-bold small">Email</label>
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@pcr.ac.id" required autocomplete="username">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="password" class="form-label text-primary fw-bold small">Password</label>
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4 text-start">
                        <label for="password_confirmation" class="form-label text-primary fw-bold small">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required autocomplete="new-password">
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 shadow-sm mb-3">Daftar</button>

                    <div class="text-secondary text-center mt-3 small">
                        Sudah Mempunyai Akun? <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Masuk</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
