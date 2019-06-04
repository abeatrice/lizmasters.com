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

<div class="row mt-3">
    <table class="table table-borderless">
        <thead class="border-bottom">
            <tr>
                <th width="7%" class="text-center">Edit</th>
                <th colspan="2" width="7%" class="text-center">Order</th>
                <th class="text-center">Image</th>
                <th>Title</th>
                <th>Description</th>
                <th class="text-center">Published</th>
                <th width="3%" class="text-center">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr class="border-bottom">
                    <td class="align-middle text-center">
                        <a href="#" class="text-info" title="Edit Post" 
                            data-toggle="modal" data-target="#editModal" data-id="{{$post->id}}" 
                            data-title="{{$post->title}}" data-description="{{$post->description}}"
                            data-published="{{$post->published}}" data-image="{{$post->storagePath()}}">
                                <i class="material-icons">edit</i>
                        </a>
                    </td>
                    <td class="align-middle text-center">
                        <form action="/posts/{{$post->id}}/order/up" method="POST">
                            @csrf
                            <button class="btn btn-link text-success" type="submit">
                                <i class="material-icons">keyboard_arrow_up</i>
                            </button>
                        </form>
                    </td>
                    <td class="align-middle">
                        <form action="/posts/{{$post->id}}/order/down" method="POST">
                            @csrf
                            <button class="btn btn-link text-warning" type="submit">
                                <i class="material-icons">keyboard_arrow_down</i>
                            </button>
                        </form>
                    </td>
                    <td class="text-center align-middle">
                        <img src="{{$post->storagePath()}}" alt="{{$post->title}}" height="100px" width="100px">
                    </td>
                    <td class="align-middle">{{$post->title}}</td>
                    <td class="align-middle">{{$post->description}}</td>
                    <td class="align-middle text-center">{{$post->published ? 'Yes' : 'No' }}</td>
                    <td class="align-middle text-center">
                        <a href="#" class="text-danger" title="Delete Post" 
                            data-toggle="modal" data-target="#deleteModal" data-id="{{$post->id}}" 
                            data-title="{{$post->title}}" data-description="{{$post->description}}"
                            data-published="{{$post->published}}" data-image="{{$post->storagePath()}}">
                                <i class="material-icons">delete</i>
                        </a>
                    </td>
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