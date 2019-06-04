@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between">
    <div>
        <h1>Posts:</h1>
    </div>
    <div>
        <button type="button" class="btn btn-primary pr-3" data-toggle="modal" data-target="#addModal"><i class="material-icons">add</i> Create Post </button>
    </div>
</div>

<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th colspan="2" width="10%"></th>
                <th>Title</th>
                <th>Description</th>
                <th>Published</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>
                        <a href="#" class="text-info" title="Edit Post" 
                            data-toggle="modal" data-target="#editModal" data-id="{{$post->id}}" 
                            data-title="{{$post->title}}" data-description="{{$post->description}}"
                            data-published="{{$post->published}}" data-image="{{$post->storagePath()}}">
                                <i class="material-icons">edit</i>
                        </a>
                    </td>
                    <td>
                        <a href="#" class="text-danger" title="Delete Post" 
                            data-toggle="modal" data-target="#deleteModal" data-id="{{$post->id}}" 
                            data-title="{{$post->title}}" data-description="{{$post->description}}"
                            data-published="{{$post->published}}" data-image="{{$post->storagePath()}}">
                                <i class="material-icons">delete</i>
                        </a>
                    </td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->description}}</td>
                    <td>{{$post->published ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('partials.posts.addModal')
@include('partials.posts.editModal')
@include('partials.posts.deleteModal')

@endsection

@section('js')
    <script src="{{ asset('js/posts/editModal.js') }}"></script>
    <script src="{{ asset('js/posts/deleteModal.js') }}"></script>
@endsection