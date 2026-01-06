<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Profile - DevForum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-light">

    @include('nav')

    <div class="container mt-5 mb-5">
        <h2 class="mb-4">My Profile</h2>

        <div class="row">
            <div class="col-lg-5 mb-4">

                {{-- Success Message --}}
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Error Message (General) --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white fw-bold">Profile Information</div>
                    <div class="card-body">
                        {{-- Added ID 'profile-form' --}}
                        <form id="profile-form" action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control"
                                    value="{{ old('username', $user->username) }}" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{ old('first_name', $user->first_name) }}" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="last_name" class="form-control"
                                        value="{{ old('last_name', $user->last_name) }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">Save Profile</button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-white fw-bold text-danger">Change Password</div>
                    <div class="card-body">
                        {{-- Added ID 'password-form' --}}
                        <form id="password-form" action="{{ route('password.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-danger btn-sm">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card shadow-sm">
                    
                    <div class="card-header bg-white p-0">
                        <ul class="nav nav-tabs card-header-tabs m-0" id="profileTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active fw-bold border-top-0 border-start-0 border-end-0 rounded-0 py-3 px-4" 
                                        id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts-content" 
                                        type="button" role="tab" aria-selected="true">
                                    My Posts ({{ $posts->count() }})
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-bold border-top-0 border-start-0 border-end-0 rounded-0 py-3 px-4" 
                                        id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments-content" 
                                        type="button" role="tab" aria-selected="false">
                                    My Comments ({{ $comments->count() }})
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body p-0">
                        <div class="tab-content" id="profileTabsContent">
                            
                            <div class="tab-pane fade show active" id="posts-content" role="tabpanel">
                                <div class="d-flex justify-content-end p-3 border-bottom">
                                    <a href="{{ route('posts.create') }}" class="btn btn-sm btn-outline-primary">+ New Post</a>
                                </div>

                                @if ($posts->isEmpty())
                                    <div class="p-5 text-center text-muted">
                                        You haven't posted anything yet.
                                    </div>
                                @else
                                    <div class="list-group list-group-flush">
                                        @foreach ($posts as $post)
                                            <div class="list-group-item p-3">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h5 class="mb-1">
                                                            <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                                                                {{ $post->title }}
                                                            </a>
                                                        </h5>
                                                        <small class="text-muted">
                                                            {{ $post->created_at->format('M d, Y') }} | 
                                                            Views: {{ $post->views }}
                                                        </small>
                                                    </div>
                                                    
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-secondary">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" 
                                                              onsubmit="return confirm('Delete this post?');">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="comments-content" role="tabpanel">
                                @if ($comments->isEmpty())
                                    <div class="p-5 text-center text-muted">
                                        You haven't commented on anything yet.
                                    </div>
                                @else
                                    <div class="list-group list-group-flush">
                                        @foreach ($comments as $comment)
                                            <div class="list-group-item p-3">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div class="w-100 pe-3">
                                                        <p class="mb-1 text-secondary">
                                                            "{{ Str::limit($comment->body, 80) }}"
                                                        </p>
                                                        <small class="text-muted">
                                                            On: <a href="{{ route('posts.show', $comment->post->id) }}">{{ $comment->post->title }}</a>
                                                            &bull; {{ $comment->created_at->format('M d, Y') }}
                                                        </small>
                                                    </div>
                                                    
                                                    <div class="d-flex gap-2">
                                                        {{-- EDIT BUTTON --}}
                                                        <a href="{{ route('comments.edit', $comment->id) }}" 
                                                        class="btn btn-sm btn-outline-secondary" 
                                                        title="Edit Comment">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>

                                                        {{-- DELETE FORM --}}
                                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" 
                                                            onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Comment">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Helper function to show error (Reusable for both forms)
            const showError = (input, message) => {
                // Remove existing error first to prevent duplicates
                if (input.classList.contains('is-invalid')) {
                    input.classList.remove('is-invalid');
                    if (input.nextElementSibling && input.nextElementSibling.classList.contains('invalid-feedback')) {
                        input.nextElementSibling.remove();
                    }
                }

                input.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback';
                errorDiv.innerText = message;
                input.parentElement.appendChild(errorDiv);
            };

            const clearErrors = (form) => {
                form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            };

            // --- 1. Validate Profile Info Form ---
            const profileForm = document.getElementById('profile-form');
            if (profileForm) {
                const usernameInput = profileForm.querySelector('input[name="username"]');
                const firstNameInput = profileForm.querySelector('input[name="first_name"]');
                const lastNameInput = profileForm.querySelector('input[name="last_name"]');
                // Optional: You can add Email Regex here if needed

                profileForm.addEventListener('submit', function (event) {
                    let isValid = true;
                    clearErrors(profileForm);

                    // Validate Names (Letters only)
                    const nameRegex = /^[a-zA-Z]+$/;
                    if (!nameRegex.test(firstNameInput.value.trim())) {
                        showError(firstNameInput, 'First name can only contain letters.');
                        isValid = false;
                    }
                    if (!nameRegex.test(lastNameInput.value.trim())) {
                        showError(lastNameInput, 'Last name can only contain letters.');
                        isValid = false;
                    }

                    // Validate Username
                    const validUsernameChars = /^[a-zA-Z0-9_-]+$/;
                    const hasLetter = /[a-zA-Z]/;

                    if (!validUsernameChars.test(usernameInput.value)) {
                        showError(usernameInput, 'Username can only contain letters, numbers, dashes, and underscores.');
                        isValid = false;
                    } else if (!hasLetter.test(usernameInput.value)) {
                        showError(usernameInput, 'Username must contain at least one letter.');
                        isValid = false;
                    }

                    if (!isValid) event.preventDefault();
                });
            }

            // --- 2. Validate Password Change Form ---
            const passwordForm = document.getElementById('password-form');
            if (passwordForm) {
                const newPasswordInput = passwordForm.querySelector('input[name="password"]');
                const confirmPasswordInput = passwordForm.querySelector('input[name="password_confirmation"]');

                passwordForm.addEventListener('submit', function (event) {
                    let isValid = true;
                    clearErrors(passwordForm);

                    // Validate Password Complexity
                    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,}$/;
                    if (!passwordRegex.test(newPasswordInput.value)) {
                        showError(newPasswordInput, 'Password must be at least 8 characters and include at least one letter and one number.');
                        isValid = false;
                    }

                    // Validate Match
                    if (newPasswordInput.value !== confirmPasswordInput.value) {
                        showError(confirmPasswordInput, 'Passwords do not match.');
                        isValid = false;
                    }

                    if (!isValid) event.preventDefault();
                });
            }
        });
    </script>
</body>

</html>