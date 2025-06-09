<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello, {{ $customer->first_name }} {{ $customer->last_name }}</h1>
    <p>Your account has been successfully created by the admin.</p>
    <p><strong>Email:</strong> {{ $customer->email }}</p>
    <p><strong>Password:</strong> {{ $password }}</p>
    <p>Please log in and update your password at your earliest convenience.</p>
    <p><a href="https://pcatalog.orbitnapp.com/login" style="color: blue; text-decoration: none;">Click here to log in</a></p>

</body>
</html>