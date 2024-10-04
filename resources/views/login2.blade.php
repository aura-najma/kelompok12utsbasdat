<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(34, 149, 180, 0.3); /* Set background color with 50% opacity */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .wrapper {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center; /* Center align content */
        }

        h1 {
            margin: 20px 0; /* Adjust margins for spacing */
            color: #2295b4; /* Font color matching background */
        }

        .inputbox {
            margin-bottom: 20px;
        }

        .inputbox input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .pass {
            margin-bottom: 20px;
        }

        .pass input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #2295b4; /* Button color matching background */
            color: white; /* Change to white for contrast */
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: rgba(34, 149, 180, 0.8); /* Slightly darker on hover */
        }

        /* Logo styling */
        .logo {
            width: 100px; /* Set the width you want */
            height: auto; /* Maintain aspect ratio */
            margin-bottom: 20px; /* Space between logo and heading */
        }
    </style>
</head>

<body>

<div class="wrapper">
    <img src="{{ asset('img/1.png') }}" alt="Logo" class="logo"> <!-- Logo image -->
    <h1>Login</h1>
    <div class="inputbox">
        <input type="text" placeholder="Username" required>
    </div>
    <div class="pass">
        <input type="password" placeholder="Password" required>
    </div>

    <button type="submit" class="btn">Login</button>
</div> 

</body>
</html>
