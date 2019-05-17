@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between">
    <div>
        <h1>Posts:</h1>
    </div>
    <div>
        <a href="/posts/create" class="btn btn-primary">Create Post</a>
    </div>
</div>

<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Descrtion</th>
                <th>Published</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{$post->title}}</td>
                    <td>{{$post->description}}</td>
                    <td>{{$post->published}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
