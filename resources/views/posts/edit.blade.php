@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between">
    <div>
        <h1>Update Post:</h1>
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

<form method="POST" action="/posts/{{$post->id}}">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" id="title" type="text" name="title" value="{{$post->title}}" autofocus required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" cols="150" rows="3" required>{{$post->description}}</textarea>
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="published" name="published" {{$post->published ? 'checked' : ''}}>
        <label class="form-check-label" for="published">Published</label>
    </div>

    <div class="form-group">
        <img src="/storage/{{$post->image_path}}" alt="{{$post->title}}" height="400" width="400">
    </div>

    <a href="/posts" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Update</button>

</form>

@endsection
