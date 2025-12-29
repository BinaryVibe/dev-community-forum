<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    @vite('resources/css/app.css')
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
            <h2>Create Your Account</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- First + Last Name -->
                <div class="form-row">
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                </div>

                <div class="form-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="btn-login">Sign Up</button>

                <p class="signup-text">
                    Already have an account?
                    <a href="{{ route('login') }}">Login</a>
                </p>
            </form>
        </div>
    </div>

</div>

</body>
</html>
