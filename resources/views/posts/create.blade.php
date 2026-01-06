<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-light">

    @include('nav')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h2 class="mb-4">Create a New Post</h2>

                {{-- Global Success Message --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">

                        {{-- Form Action points to the 'store' route --}}
                        <form action="{{ route('posts.store') }}" method="POST">
                            @csrf {{-- CRITICAL: Security Token --}}

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                {{-- value="{{ old('title') }}" keeps the text if validation fails --}}
                                <input type="text" id="title" name="title"
                                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                    required>

                                {{-- Validation Error Message --}}
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="body" class="form-label">Body</label>
                                <textarea id="body" name="body" rows="8"
                                    class="form-control @error('body') is-invalid @enderror"
                                    required>{{ old('body') }}</textarea>

                                @error('body')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Publish</button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/change_active_navbar_link.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const titleInput = document.querySelector('#title');
            const bodyInput = document.querySelector('#body');

            if (form) {
                form.addEventListener('submit', function (event) {
                    let isValid = true;

                    // 1. Clear previous error styles
                    document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                    document.querySelectorAll('.invalid-feedback.js-error').forEach(el => el.remove());

                    // Helper function to show error
                    const showError = (input, message) => {
                        input.classList.add('is-invalid');

                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback js-error'; // Add js-error class to distinguish from server errors
                        errorDiv.innerText = message;

                        // Insert error after the input
                        input.parentElement.appendChild(errorDiv);
                        isValid = false;
                    };

                    // 2. Validate Title
                    const titleValue = titleInput.value.trim();
                    if (titleValue.length === 0) {
                        showError(titleInput, 'Title is required.');
                    } else if (titleValue.length > 255) {
                        showError(titleInput, 'Title cannot exceed 255 characters.');
                    }

                    // 3. Validate Body
                    const bodyValue = bodyInput.value.trim();
                    if (bodyValue.length === 0) {
                        showError(bodyInput, 'Post body cannot be empty.');
                    }

                    // 4. Prevent submission if validation failed
                    if (!isValid) {
                        event.preventDefault();
                    }
                });
            }
        });
    </script>
</body>

</html>