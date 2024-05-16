<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Platform</title>
    <style>
        /* Inline CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 200px;
            height: auto;
        }

        .content {
            text-align: center;
        }

        .content h1 {
            color: #333333;
            margin-bottom: 20px;
        }

        .content p {
            color: #666666;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="https://static.vecteezy.com/system/resources/thumbnails/021/809/795/small/doctors-day-illustration-png.png" alt="Hospital Logo">
        </div>
        <div class="content">
            <h1>Welcome, {{$name}}!</h1>
            <p>This is your account to access employee application</p>
            <p>Your username: {{$email}}</p>
            <p>Your password: {{$password}}</p>
            <p>Please keep this information secure.</p>
            <p>Thank you!</p>
        </div>
    </div>
</body>
</html>
