<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="{{ asset('css/userPanel/userLogin.css') }}">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
</head>

<body>

    <div class="logo-container">
        <a href="/"> <img src="{{ asset('storage/images/PostifyLogo.png') }}" alt="Logo"></a>
    </div>

    <div class="login">
        <h1>Login</h1>
        <p>Please enter your credentials to log in.</p>
        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form action="{{ route('user.login.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <button type="submit">Sign In</button>
            </div>

            <div class="form-group">
                <a id="createAccount" href="{{ route('user.signUp') }}" type="button">Sign Up</a>
            </div>
        </form>
    </div>

</body>

</html>