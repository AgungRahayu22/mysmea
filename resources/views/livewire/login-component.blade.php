<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library Management System</title>
    <link href="assets/img/logomy.png" rel="icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            display: flex;
            max-width: 1200px; /* Lebar container ditingkatkan */
            width: 100%;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .image-section {
            flex: 1.5; /* Gambar lebih besar */
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .image-section img {
            max-width: 90%; /* Ukuran gambar lebih besar */
            height: auto;
        }

        .form-section {
            flex: 1; /* Form lebih kecil dibandingkan gambar */
            padding: 40px; /* Padding ditingkatkan */
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px; /* Jarak antar elemen ditingkatkan */
        }

        .login-header img {
            width: 100px; /* Ukuran logo ditingkatkan */
            height: 100px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .login-header h2 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #343a40;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative; /* To position the icons */
        }

        .form-control {
            height: 50px; /* Tinggi input lebih besar */
            font-size: 16px; /* Ukuran teks input lebih besar */
            border: none; /* Menghilangkan border */
            border-bottom: 2px solid #343a40; /* Menambahkan garis bawah */
            outline: none; /* Menghilangkan outline saat input fokus */
            padding-left: 35px; /* Space for the icon */
        }

        .form-control:focus {
            border-bottom-color: #007bff; /* Mengubah warna garis bawah saat fokus */
        }

        .form-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #343a40;
        }

        .btn-login {
            width: 100%;
            height: 50px; /* Tinggi tombol ditingkatkan */
            font-size: 16px;
            border-radius: 5px;
            padding: 10px;
        }

        .text-center {
            margin-top: 20px;
        }

        .text-center a {
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Bagian Gambar -->
        <div class="image-section">
            <img src="assets/img/undraw_collaborators_rgw4.svg" alt="Ilustrasi login">
        </div>

        <!-- Bagian Form -->
        <div class="form-section">
            <div class="login-header">
                <img src="{{ asset('assets/img/logomy.png') }}" alt="Library Logo">
                <h2>MySmeaBooks Log In</h2>
            </div>
            <div>
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
            </div>
            <form>
                <div class="form-group">
                    <i class="fas fa-envelope"></i> <!-- Email Icon -->
                    <input type="text" wire:model="email" class="form-control" id="email" placeholder="Email Address" required>
                    @error('email')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i> <!-- Lock Icon for Password -->
                    <input type="password" wire:model="password" class="form-control" id="password" placeholder="Password" required>
                    @error('password')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="button" wire:click="proses" class="btn btn-primary btn-login">Login</button>
            </form>
            <div class="text-center">
                <p>Belum Punya Akun? <a href="{{ route('register') }}">Register</a></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
