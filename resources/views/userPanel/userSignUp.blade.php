<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>
    <link rel="stylesheet" href="{{ asset('css/userPanel/registerForm.css') }}">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
</head>

<body>
    <div class="logo-container">
        <a href="/"><img src="{{ asset('images/PostifyLogo.png') }}" alt="Logo"></a>
    </div>
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="register">
        <h1>Register as User</h1>
        <p>Create your account</p>
    </div>
    <form action="{{ route('user.signUp.submit') }}" method="POST">
        @csrf

        <div class="form-group">
            <input type="text" name="name" placeholder="Name" required>
        </div>

        <div class="form-group">
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="form-group">
            <input type="password" name="RePassword" placeholder="Re-Password" required>
        </div>

        <div class="form-group">
            <button type="submit">Sign Up</button>
        </div>
    </form>

    <div id="signIn">
        <a href="{{ route('login') }}">Sign In</a>
    </div>
</body>

</html>