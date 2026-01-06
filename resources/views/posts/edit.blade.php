<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    @include('nav')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white fw-bold">Edit Post</div>
                    <div class="card-body">
                        
                        <form action="{{ route('posts.update', $post->id) }}" method="POST">
                            @csrf
                            @method('PUT') {{-- Required for Updates --}}

                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Body</label>
                                <textarea name="body" rows="8" class="form-control" required>{{ old('body', $post->body) }}</textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Post</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>