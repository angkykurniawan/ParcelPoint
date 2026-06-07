<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} | Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{ url('Crovex/HTML/assets/images/ParcelPointLogoOnly.png') }}">
    <link rel="stylesheet" href="css/loginCSS.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        /* Password Icon */
        .toggle-password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 75%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #0d6efd; /* Blue color */
        }

        .password-checkbox {
            display: none;
        }

        .password-checkbox:checked ~ .password-input {
            -webkit-text-security: none;
            text-security: none;
        }

        .password-checkbox:checked ~ .toggle-password .bi {
            content: "\f606"; /* Icon for eye-slash */
        }

        /* Remember Me Checkbox Alignment and Style */
        .form-check {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-check-label {
            margin-left: 0.5rem;
            font-size: 1rem;
            color: #0d6efd; /* Blue color */
            font-weight: bold;
        }

        /* Input Field Borders */
        .form-control {
            border: 2px solid #0d6efd;
            border-radius: 4px;
        }

        .form-control:focus {
            box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
            border-color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Left side Image -->
            <div class="login-image"></div>

            <!-- Right side Form -->
            <div class="login-form">
                <center><img src="{{ url('Crovex/HTML/assets/images/ParcelPointWithText.png') }}" alt="ParcelPoint" width="250px" height="100px"></center>
                <center><h3 class="text-primary" style="font-weight: bolder;">Masuk</h3></center>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label text-primary" style="font-weight: bolder;">Email</label>
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3 toggle-password-container">
                        <label for="password" class="form-label text-primary" style="font-weight: bolder;">Password</label>
                        <input id="password" type="password" name="password" class="form-control password-input @error('password') is-invalid @enderror" required>
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

                    <!-- Remember Me -->
                    <div class="form-check mb-3">
                        <input id="remember" type="checkbox" name="remember" class="form-check-input text-primary" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="form-check-label">Ingat Saya</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Masuk</button>
                </form>

                <!-- Links -->
                <div class="text-secondary text-center mt-4">
                    Belum Mempunyai Akun? <a href="{{ route('register') }}">Daftar</a>
                </div>
                <div class="text-secondary text-center mt-2">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Lupa Password?</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
