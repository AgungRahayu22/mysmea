<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Library Management System</title>
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

        .register-container {
            display: flex;
            max-width: 1200px; /* Reduced size */
            width: 100%;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .image-section {
            flex: 1.2; /* Adjusted size of the image section */
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .image-section img {
            max-width: 80%; /* Reduced image size */
            height: auto;
        }

        .form-section {
            flex: 1;
            padding: 30px; /* Reduced padding */
        }

        .register-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .register-header img {
            width: 80px; /* Reduced logo size */
            height: 80px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .register-header h2 {
            margin-bottom: 15px; /* Reduced spacing */
            font-weight: bold;
            color: #343a40;
        }

        .form-group {
            margin-bottom: 1.2rem; /* Reduced bottom margin */
            position: relative;
        }

        .form-control {
            height: 40px; /* Reduced input height */
            font-size: 14px; /* Smaller font size */
            border: none;
            border-bottom: 2px solid #343a40;
            outline: none;
            padding-left: 30px; /* Adjusted padding */
        }

        .form-control:focus {
            border-bottom-color: #007bff;
        }

        .form-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #343a40;
        }

        .btn-register {
            width: 100%;
            height: 45px; /* Reduced button height */
            font-size: 14px; /* Smaller font size */
            border-radius: 5px;
            padding: 10px;
        }

        .text-center {
            margin-top: 15px;
        }

        .text-center a {
            color: #007bff;
        }

        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <!-- Bagian Gambar -->
        <div class="image-section">
            <img src="assets/img/undraw_in-the-office_ma2b.svg" alt="Ilustrasi Register">
        </div>

        <!-- Bagian Form -->
        <div class="form-section">
            <div class="register-header">
                <img src="{{ asset('assets/img/logomy.png') }}" alt="Library Logo">
                <h2>MySmeaBooks Register</h2>
            </div>
            <form wire:submit.prevent="register">
                <div class="form-group">
                    <i class="fas fa-user"></i> <!-- User Icon -->
                    <input type="text" wire:model="nama" class="form-control" id="nama" placeholder="Nama" required>
                    @error('nama')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <i class="fas fa-envelope"></i> <!-- Email Icon -->
                    <input type="email" wire:model="email" class="form-control" id="email" placeholder="Email Address" required>
                    @error('email')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <i class="fas fa-eye eye-icon" id="togglePassword" onclick="togglePasswordVisibility()"></i>
                    <input type="password" wire:model="password" class="form-control" id="password" placeholder="Password" required>
                     <!-- Eye Icon for Toggle -->
                    @error('password')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i> <!-- Lock Icon for Confirm Password -->
                    <input type="password" wire:model="password_confirmation" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password" required>
                    @error('password_confirmation')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <i class="fas fa-phone"></i> <!-- Phone Icon -->
                    <input type="text" wire:model="telepon" class="form-control" id="telepon" placeholder="Nomor HP" required>
                    @error('telepon')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea wire:model="alamat" class="form-control" id="alamat" placeholder="Alamat" rows="3"></textarea>
                    @error('alamat')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <select wire:model="jenis" class="form-control" id="jenis" required>
                        <option value="" disabled selected>Pilih Jenis</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                        <option value="user">User</option>
                    </select>
                    @error('jenis')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-register">Register</button>
            </form>
            <div class="text-center">
                <p>Sudah Punya Akun? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById('password');
            var eyeIcon = document.getElementById('togglePassword');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }

            var confirmPasswordField = document.getElementById('password_confirmation');
            if (confirmPasswordField.type === "password") {
                confirmPasswordField.type = "text";
            } else {
                confirmPasswordField.type = "password";
            }
        }
    </script>

</body>

</html>
