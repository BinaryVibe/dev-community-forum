<header class="main-header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#collapsible-bar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <a href="{{ route('index') }}" class="navbar-brand">
                <i class="bi bi-code-slash" style="font-size: 1.5rem; color: #6f42c1;"></i>
                <span>DevForum</span>
            </a>

            <div class="collapse navbar-collapse" id="collapsible-bar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}" 
                           href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('posts.index') }}" 
                            class="nav-link {{ request()->routeIs('posts.index') ? 'active' : '' }}">
                            Posts
                        </a> 
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about') }}" class="nav-link">About</a>
                    </li>
                </ul>

            </div>

            @auth
                <div class='d-flex flex-nowrap column-gap-2 align-items-center'>
                    
                    <a href="{{ route('posts.create') }}" data-bs-toggle="tooltip" data-bs-title="Create Post" 
                       class='nav-item btn btn-primary' role='button'>
                        <i class='bi bi-plus-lg'></i>
                    </a>

                    <div class='dropdown'>
                        <button class='btn btn-secondary dropdown-toggle d-flex align-items-center gap-2' type='button' data-bs-toggle='dropdown'
                            aria-expanded='false'>
                            <i class='bi bi-person-circle'></i>
                            <span class="small">{{ Auth::user()->username }}</span>
                        </button>
                        
                        <ul class='dropdown-menu dropdown-menu-end'>
                            <li><a class='dropdown-item' href='{{ route('profile.edit') }}'>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item link-danger">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

            @else
                <div class='auth-btns d-flex flex-nowrap column-gap-2'>
                    <a href="{{ route('login') }}" class='nav-item btn btn-primary' role='button'>Login</a>
                    <a href="{{ route('signup') }}" class='nav-item btn btn-outline-primary' role='button'>Sign Up</a>
                </div>

            @endauth
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    });
</script>