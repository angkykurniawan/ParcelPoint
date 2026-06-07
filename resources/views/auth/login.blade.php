<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} | Login</title>
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
                min-height: 520px;
            }
            .login-form {
                flex: 0 0 35%;
                padding: 40px;
            }
        }
        .toggle-password-container {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            bottom: 12px;
            right: 15px;
            cursor: pointer;
            color: #0d6efd;
            z-index: 10;
        }
        .password-checkbox {
            display: none;
        }
        .password-checkbox:checked ~ .password-input {
            -webkit-text-security: none;
            text-security: none;
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
        .form-check {
            display: flex;
            align-items: center;
            justify-content: start;
            margin-bottom: 20px;
        }
        .form-check-label {
            margin-left: 0.5rem;
            font-size: 0.95rem;
            color: #0d6efd;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-primary {
            border-radius: 12px;
            width: 100%;
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
                <h3 class="text-primary text-center" style="font-weight: bolder;">Masuk</h3>

                @if (session('status'))
                    <div class="alert alert-success border-0 small rounded-3 mb-3">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3 text-start">
                        <label for="email" class="form-label text-primary fw-bold small">Email</label>
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@pcr.ac.id" required autofocus autocomplete="username">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start toggle-password-container">
                        <label for="password" class="form-label text-primary fw-bold small">Password</label>
                        <input id="password" type="password" name="password" class="form-control password-input @error('password') is-invalid @enderror" placeholder="••••••••" required autocomplete="current-password">

                        <input type="checkbox" id="show-password" class="password-checkbox">
                        <label for="show-password" class="toggle-password">
                            <i class="bi bi-eye"></i>
                        </label>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input id="remember" type="checkbox" name="remember" class="form-check-input mt-0" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="form-check-label">Ingat Saya</label>
                    </div>

                    <button type="submit" class="btn btn-primary shadow-sm mb-3">Masuk</button>
                </form>

                <div class="text-secondary text-center mt-3 small">
                    Belum Mempunyai Akun? <a href="{{ route('register') }}" class="fw-bold text-decoration-none">Daftar</a>
                </div>
                <div class="text-secondary text-center mt-2 small">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Lupa Password?</a>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script>
        const checkbox = document.getElementById('show-password');
        const icon = document.querySelector('.toggle-password i');
        checkbox.addEventListener('change', function() {
            if(this.checked) {
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    </script>
</body>
</html>
