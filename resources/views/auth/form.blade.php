<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dev Community Forum</title>

    <!-- Google Font (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row min-vh-100 align-items-center column-gap-5 row-gap-5">


            <!-- Left Side (Promo) -->
            <div class="col-sm d-flex flex-column min-vh-100 auth-promo">
                <a href="index.php" class="mb-3 pt-5 back-link">&larr; Back to Home</a>
                <div class="m-auto ps-4">
                    <h2>Join the largest community of developers worldwide.</h2>
                </div>
            </div>

            <!-- Right Side (Form) -->
            <div class="col text-center">

                <form class="ps-5 pe-5" action="{{ $mode == 'login' ? route('auth.verify') : route('auth.register') }}"
                    method="POST">
                    <div class="mb-5">
                        <img src="images/account.svg" alt="Account Icon" width="40" height="40">

                        <h1>{{ $mode == 'login' ? 'Welcome Back' : 'Create Your Account' }}</h1>
                    </div>

                    @if ($mode == 'login')
                        <div class="mb-3 text-start">
                            <label for="identifier" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    @else
                        <div class="mb-3 input-group">
                            <span class="input-group-text">First Name | Last Name</span>
                            <input type="text" aria-label="First name" class="form-control" name="first_name" required>
                            <input type="text" aria-label="Last name" class="form-control" name="last_name" required>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" name="username" placeholder="ajohndoe123"
                                required>
                            <label for="username">Username</label>

                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="john@example.com"
                                required>
                            <label for="email">Email</label>

                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password" required
                                placeholder="apassword">
                            <label for="password">Password</label>

                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password"
                                required placeholder="apassword">
                            <label for="confirm-password" class="form-label">Confirm Password</label>

                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary">Login</button>

                    <p class="auth-switch-link">
                        @if ($mode == 'login')
                            Don't have an account?
                            <a href="{{ route('signup') }}">Sign Up</a>
                        @else
                            Already have an account?
                            <a href="{{ route('login') }}">Login</a>
                        @endif
                    </p>
                </form>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</body>

</html>