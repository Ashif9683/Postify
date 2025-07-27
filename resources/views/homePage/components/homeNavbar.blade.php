<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/home/homeNav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/homePage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/postPage.css') }}">
    <title>Postify</title>
</head>

<body></body>

<nav class="navbar">
    <div>
        <a href="/"><img src="{{ asset('images/PostifyLogo.png') }}" alt="Logo"></a>
    </div>

    <div class="nav-links">
        <a href="{{ route('user.signUp') }}">Sign Up</a>
        <a id="signId" href="{{ route('login') }}">Log In</a>
    </div>
</nav>