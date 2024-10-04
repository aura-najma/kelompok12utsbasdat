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
        img {
            max-width: 100%;
            margin-bottom: 1rem;
        }
        .text-custom {
            color: #2295B4; 
        }
        .btn-toggle:hover {
            background-color: #a4c757; 
            color: yellow; 
        }
    </style>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleButton = document.getElementById('togglePasswordButton');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleButton.innerText = 'Hide';
            } else {
                passwordField.type = 'password';
                toggleButton.innerText = 'Show Me';
            }
        }
    </script>
</head>
<body>
<div class="login-container">
    <img src="{{ asset('img/1.png') }}" alt="Logo">
    <h3 class="text-custom">Login Apoteker</h3>
    <form id="loginForm">
        @csrf
        <div class="mb-3">
            <label for="nomorRegistrasi" class="form-label text-custom">Nomor Registrasi Apoteker</label>
            <input type="text" class="form-control" id="nomorRegistrasi" name="nomor_registrasi" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label text-custom">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" required>
                <button type="button" class="btn btn-outline-secondary btn-toggle" id="togglePasswordButton" onclick="togglePassword()">Show Me</button>
            </div>
        </div>
        <button type="submit" class="btn btn-custom w-100" style="background-color: #2295B4; color: white;">Login</button>
    </form>
</div>

<script>
function togglePassword() {
    var passwordField = document.getElementById('password');
    var toggleButton = document.getElementById('togglePasswordButton');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleButton.textContent = 'Hide';
    } else {
        passwordField.type = 'password';
        toggleButton.textContent = 'Show Me';
    }
}

// Handle form submission and redirect to dashboard
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form from submitting normally
    window.location.href = "{{ route('dashboardutama') }}"; // Redirect to dashboard page
});
</script>


</body>
</html>
