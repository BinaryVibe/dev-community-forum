@php use Illuminate\Support\Str; @endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dev Community Forum</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@include('nav')

<div class="container mt-5">
    <h2 class="mb-4">Recent Posts (Last 7 Days)</h2>

    @if ($posts->isEmpty())
        <div class="alert alert-warning">No posts found from the last week.</div>
    @else
        @foreach ($posts as $post)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">

                    <h4 class="card-title">
                        <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                            {{ $post->title }}
                        </a>
                    </h4>

                    <div class="text-muted mb-2 small">
                        <strong>By:</strong>
                        {{ $post->user->first_name ?? 'Unknown' }} {{ $post->user->last_name ?? '' }}
                        <span class="mx-2">|</span>
                        
                        <strong>Published:</strong>
                        {{ $post->created_at->diffForHumans() }}
                        <span class="mx-2">|</span>

                        <strong>Views:</strong>
                        {{ $post->views }}
                    </div>

                    <p class="card-text text-secondary">
                        {{ Str::limit($post->body, 200) }}
                    </p>
                    
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-primary">Read More</a>

                </div>
            </div>
        @endforeach
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/change_active_navbar_link.js') }}"></script>

</body>
</html>