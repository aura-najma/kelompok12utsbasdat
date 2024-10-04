<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login Apoteker</title>
    <style>
        body {
            background-color: rgba(34, 149, 180, 0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: white; 
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        .text-custom {
            color: #2295B4; 
        }
        .btn-custom {
            background-color: #2295B4; 
            color: white; 
        }
        .btn-custom:hover {
            background-color: #1a758e; 
        }
    </style>
</head>
<body>
<div class="login-container">
    <h3 class="text-custom">Login Apoteker</h3>
    <form id="loginForm" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nip" class="form-label text-custom">Nomor Induk Pegawai</label>
            <input type="text" class="form-control" id="nip" name="nip" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label text-custom">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-custom w-100">Login</button>
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                {{ $errors->first('nip') }}
            </div>
        @endif
    </form>
</div>
</body>
</html>
