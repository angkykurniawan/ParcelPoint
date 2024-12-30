<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} | Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{ url('Crovex/HTML/assets/images/ParcelPointLogoOnly.png') }}">
    <link rel="stylesheet" href="css/loginCSS.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Left side Image -->
            <div class="login-image"></div>

            <!-- Right side Form -->
            <div class="login-form">
                <center>
                    <img src="{{ url('Crovex/HTML/assets/images/ParcelPointWithText.png') }}" alt="ParcelPoint" width="250px" height="100px">
                </center>
                <center><h3 class="text-primary" style="font-weight: bolder;">Lupa Password</h3></center>

                <!-- Form -->
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label text-primary" style="font-weight: bolder;">Email</label>
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus autocomplete="username">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100">Kirim Link Ganti Password</button>
                </form>

                <!-- Back to Login -->
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-primary" style="text-decoration: none;">Kembali ke Halaman Masuk</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
