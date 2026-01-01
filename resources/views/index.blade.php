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

    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

@include('nav')

<div class="container mt-5">
    <h2 class="mb-4">Recent Posts (Last 7 Days)</h2>

    @if ($posts->isEmpty())
        <div class="alert alert-warning">No posts in the last week.</div>
    @else
        @foreach ($posts as $post)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">

                    <h4 class="card-title">
                        <a href="{{ url('posts/' . $post->post_id) }}">
                            {{ $post->title }}
                        </a>
                    </h4>

                    <div class="text-muted mb-2">
                        <strong>By:</strong>
                        {{ $post->first_name }} {{ $post->last_name }}
                        |
                        <strong>Published:</strong>
                        {{ $post->created_at }}
                        |
                        <strong>Views:</strong>
                        {{ $post->views }}
                    </div>

                    <p class="card-text">
                        {{ Str::limit($post->body, 200) }}
                    </p>

                </div>
            </div>
        @endforeach
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/change_active_navbar_link.js') }}"></script>

</body>
</html>
