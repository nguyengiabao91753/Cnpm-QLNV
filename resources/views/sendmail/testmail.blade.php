<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="/sendmail" method="post">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="email">Name:</label>
        <input type="text"  name="name" required>
        <label for="email">Pass:</label>
        <input type="password"  name="password" required>
        <button type="submit">Send Email</button>
    </form>
</body>
</html>