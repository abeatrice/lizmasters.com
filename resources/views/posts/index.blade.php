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
                <th colspan="2"></th>
                <th>Title</th>
                <th>Description</th>
                <th>Published</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>
                        <a href="/posts/{{$post->id}}/edit">edit</a>
                    </td>
                    <td>
                        <form action="{{$post->path()}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="delete" class="btn btn-link">
                        </form>
                    </td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->description}}</td>
                    <td>{{$post->published ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
