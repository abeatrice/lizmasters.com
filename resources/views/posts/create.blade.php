@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between">
    <div>
        <h1>Create Post:</h1>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/posts" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="title">title</label>
        <input class="form-control" id="title" type="text" name="title" autofocus required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" cols="150" rows="3" required></textarea>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="published" name="published">
        <label class="form-check-label" for="published">Published</label>
    </div>

    <div class="form-group">
        <input class="form-control-file" type="file" name="image_path" id="image" required>
    </div>

    <a href="/posts" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Create Post</button>

</form>

@endsection
