<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Comment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    @include('nav')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white fw-bold">Edit Comment</div>
                    <div class="card-body">

                        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Comment</label>
                                <textarea name="body" rows="5" class="form-control"
                                    required>{{ old('body', $comment->body) }}</textarea>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('profile.edit') }}"
                                    class="text-decoration-none text-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Comment</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>