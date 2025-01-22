<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>

<body>
    <h1 style="text-align: center;">Welcome Page</h1>

    <div style="display: flex; justify-content:space-evenly">
        <a href="{{route('signup.get')}}">Sign up</a>
        <a href="{{route('login.get')}}">Login</a>
    </div>


</body>

</html>