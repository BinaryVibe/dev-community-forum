<html>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="{{ asset('resources/css/auth_form_styles.css') }}"> -->
    @vite(['resources/css/auth_form_styles.css', 'resources/js/app.js', 'resources/js/validate_signup.js']);
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

                <form class="ps-5 pe-5" action="{{ $mode == 'login' ? route('verify') : route('register') }}"
                    method="POST">
                    @csrf

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show text-start" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mb-5">
                        <i class="bi bi-person-circle text-primary" style="font-size: 2.5rem;"></i>
                        <h1>{{ $mode == 'login' ? 'Welcome Back' : 'Create Your Account' }}</h1>
                    </div>

                    @if ($mode == 'login')
                        <div class="mb-3 text-start">
                            <label for="login-email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="login-email"
                                name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label for="login-password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="login-password" name="password" required>
                        </div>

                    @else
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">First Name | Last Name</span>

                                <input type="text" aria-label="First name"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}" required>

                                <input type="text" aria-label="Last name"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') }}" required>
                            </div>
                            @error('first_name')
                                <div class="text-danger small mt-1 text-start">{{ $message }}</div>
                            @enderror
                            @error('last_name')
                                <div class="text-danger small mt-1 text-start">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                                name="username" placeholder="ajohndoe123" value="{{ old('username') }}" required>
                            <label for="username">Username</label>
                            @error('username')
                                <div class="invalid-feedback text-start">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="john@example.com" value="{{ old('email') }}" required>
                            <label for="email">Email</label>
                            @error('email')
                                <div class="invalid-feedback text-start">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="apassword" required>
                            <label for="password">Password</label>
                            @error('password')
                                <div class="invalid-feedback text-start">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password"
                                required placeholder="apassword">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        {{ $mode == 'login' ? 'Login' : 'Sign Up' }}
                    </button>

                    <p class="auth-switch-link mt-3">
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
    @if ($mode != 'login')
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');

        // Select Inputs
        const firstNameInput = document.querySelector('input[name="first_name"]');
        const lastNameInput = document.querySelector('input[name="last_name"]');
        const usernameInput = document.querySelector('input[name="username"]');
        const passwordInput = document.querySelector('input[name="password"]');
        
        const confirmPasswordInput = document.querySelector('input[name="confirm-password"]');

        if (form) {
            form.addEventListener('submit', function (event) {
                let isValid = true;

                // 1. Clear previous error messages
                document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

                // Helper to display errors
                const showError = (input, message) => {
                    input.classList.add('is-invalid');
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback';
                    errorDiv.innerText = message;

                    // Handle input groups (like first/last name) correctly
                    if (input.parentElement.classList.contains('input-group')) {
                        input.parentElement.parentElement.appendChild(errorDiv);
                    } else {
                        input.parentElement.appendChild(errorDiv);
                    }
                    isValid = false;
                };

                // 2. Validate Names (Regex: Letters only)
                const nameRegex = /^[a-zA-Z]+$/;

                if (!nameRegex.test(firstNameInput.value.trim())) {
                    showError(firstNameInput, 'First name can only contain letters (no spaces or numbers).');
                }

                if (!nameRegex.test(lastNameInput.value.trim())) {
                    showError(lastNameInput, 'Last name can only contain letters (no spaces or numbers).');
                }

                // 3. Validate Username
                const validUsernameChars = /^[a-zA-Z0-9_-]+$/; 
                const hasLetter = /[a-zA-Z]/;                 

                if (!validUsernameChars.test(usernameInput.value)) {
                    showError(usernameInput, 'Username can only contain letters, numbers, dashes, and underscores.');
                } else if (!hasLetter.test(usernameInput.value)) {
                    showError(usernameInput, 'Username must contain at least one letter.');
                }

                // 4. Validate Password Complexity
                const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,}$/;
                
                if (!passwordRegex.test(passwordInput.value)) {
                    showError(passwordInput, 'Password must be at least 8 characters and include at least one letter and one number.');
                }

                // 5. Validate Password Match
                if (passwordInput.value !== confirmPasswordInput.value) {
                    showError(confirmPasswordInput, 'Passwords do not match.');
                }

                // Stop submission if any check failed
                if (!isValid) {
                    event.preventDefault();
                }
            });
        }
    });
</script>
    @endif
</body>

</html>