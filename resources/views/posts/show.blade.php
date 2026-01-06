@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-light">

    @include('nav')

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-9">

                {{-- Alert Messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Main Post Card --}}
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h1 class="mb-3">{{ $post->title }}</h1>

                        <div class="text-muted mb-3">
                            <strong>By:</strong>
                            {{ $post->user->first_name }} {{ $post->user->last_name }}
                            |
                            <strong>Username:</strong>
                            {{ $post->user->username }}
                            |
                            <strong>Views:</strong>
                            {{ $post->views }}
                        </div>

                        <div class="mb-4">
                            {{-- nl2br(e(...)) escapes HTML but keeps line breaks --}}
                            <p>{!! nl2br(e($post->body)) !!}</p>
                        </div>

                        <hr>

                        {{-- Voting Section --}}
                        <div class="d-flex align-items-center gap-3 mb-3">
                            
                            {{-- Upvote Form --}}
                            <form method="POST" action="{{ route('posts.vote', $post->id) }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="action" value="upvote">
                                <button type="submit" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-arrow-up-circle-fill"></i> Upvote ({{ $post->upvotes }})
                                </button>
                            </form>

                            {{-- Downvote Form --}}
                            <form method="POST" action="{{ route('posts.vote', $post->id) }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="action" value="downvote">
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-arrow-down-circle-fill"></i> Downvote ({{ $post->downvotes }})
                                </button>
                            </form>
                        </div>

                        <div class="text-muted small">
                            Created at: {{ $post->created_at->format('Y-m-d H:i') }}<br>
                            Updated at: {{ $post->updated_at->format('Y-m-d H:i') }}
                        </div>

                    </div>
                </div>

                {{-- Comments Section --}}
                <div class="mt-5" id="comments-section">
                    <h3>Comments</h3>

                    {{-- Add Comment Form (Only for logged in users) --}}
                    @auth
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="{{ route('comments.store', $post->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Add a comment</label>
                                        <textarea name="comment_body" class="form-control" rows="3" required></textarea>
                                        @error('comment_body')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Post Comment</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            You must be <a href="{{ route('login') }}">logged in</a> to post a comment.
                        </div>
                    @endauth

                    {{-- List Comments --}}
                    @if ($post->comments->isNotEmpty())
                        @foreach ($post->comments as $comment)
                            <div class="card mb-2">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong class="text-primary">
                                            @ {{ $comment->user->username }}
                                        </strong>
                                        <small class="text-muted">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <p class="mb-0">{!! nl2br(e($comment->body)) !!}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">No comments yet.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>