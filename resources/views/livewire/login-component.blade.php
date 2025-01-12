<div>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            max-width: 400px;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .login-header h2 {
            margin-bottom: 0;
            font-weight: bold;
            color: #343a40;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 50px;
        }

        .btn-login {
            width: 100%;
            border-radius: 50px;
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
        <div class="login-header">
            <img src="library-logo.png" alt="Library Logo">
            <h2>Perpustakaan Login</h2>
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
                <input type="text" wire:model="email" class="form-control" id="email"
                placeholder="Email Address" required>
                @error('email')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}

                    </div>
                @enderror
            </div>
            <div class="form-group">
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
            <a href="#">Forgot password?</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>{{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
</div>
