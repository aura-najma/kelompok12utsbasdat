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
        }
        .login-container {
            background-color: white;
            padding: 2rem;
            border-radius: 5px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            color: #2295B4;
        }
        .btn-login {
            background-color: #2295B4;
            color: white;
        }
        .btn-login:hover {
            background-color: #1a758e;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center">Login Apoteker</h2>

        <!-- Menampilkan pesan error jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nip" class="form-label">Nomor Induk Pegawai (NIP)</label>
                <input type="text" class="form-control" id="nip" name="nip" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-login w-100">Login</button>
        </form>
    </div>

    <script>
        // Menangani alur login
        document.querySelector('form').addEventListener('submit', function(event) {
            // Tindakan tambahan bisa ditambahkan di sini
        });
    </script>
</body>
</html>
