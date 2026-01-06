<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About Us - DevForum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    @include('nav')

    <div class="container mt-5 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">

                <h1 class="display-5 fw-bold mb-4">About DevForum</h1>

                <p class="lead text-muted mb-5">
                    DevForum is a global community for developers to share knowledge, discuss code, and grow together.
                </p>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <h3 class="mb-4">Meet the Developers</h3>

                        <div class="row justify-content-center">
                            <div class="col-md-5 mb-3">
                                <div class="p-3 border rounded bg-light">
                                    <i class="bi bi-person-fill display-4 text-primary"></i>
                                    <h5 class="mt-2 fw-bold">Haris Ali</h5>
                                    <span class="text-muted small">Developer</span>
                                </div>
                            </div>

                            <div class="col-md-5 mb-3">
                                <div class="p-3 border rounded bg-light">
                                    <i class="bi bi-person-fill display-4 text-primary"></i>
                                    <h5 class="mt-2 fw-bold">Umar Nasir</h5>
                                    <span class="text-muted small">Developer</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="text-center py-4 text-muted mt-auto">
        &copy; {{ date('Y') }} DevForum. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>