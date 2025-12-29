<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="auth-container">

    <!-- LEFT PANEL -->
    <div class="left-panel">
        <a href="{{ url('/') }}" class="back-link">← Back to Home</a>

        <div class="left-content">
            <h2>Join the largest community of developers worldwide.</h2>
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="right-panel">
        <div class="form-box">
            <div class="icon">👤</div>
            <h2>Welcome Back</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label>Username or Email</label>
                    <input type="text" name="email" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <button type="submit" class="btn-login">Login</button>

                <p class="signup-text">
                    Don’t have an account?
                    <a href="{{ route('register') }}">Sign Up</a>
                </p>
            </form>
        </div>
    </div>

</div>

</body>
</html>
