@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="flex-column text-center">
            <img class="rounded-circle mt-0 mb-2" alt="Liz Masters" src="/storage/images/liz.png" height="80" width="80">
            <h2 class="mb-0">Liz Masters</h2>
            <h4 class="text-muted mb-2"><small>Burbank</small></h3>
            <h4 class="text-muted">Illustrator / Etsy Shop Owner / Emoji Designer </h4>
            <h5 class="text-muted">
                <small>character design, creature design, emojis, enamel pins, illustration, stickers</small>
            </h5>
            @include('partials.social')
        </div>
    </div>
    <hr>

    @if (session('status'))
        <div class="alert alert-success flash-message alert-dismissible fade show shadow-sm border border-success" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        @foreach ($posts as $post)
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-4">
                <a href="#" data-toggle="modal" data-target="#imageModal"
                    data-path="{{$post->storagePath()}}" data-title="{{$post->title}}" data-description="{{$post->description}}">
                        <img src="{{$post->storagePath()}}" class="card-img-top" alt="{{$post->title}}">
                </a>
            </div>
        @endforeach
    </div>

    @include('partials.imageModal')
    @include('partials.emailModal')

    {{$posts->links()}}

    <hr>

    <div class="d-flex-justify-content-center">
        <p class="text-muted text-center"><small>Copyright © {{date('Y')}} Liz Masters</small></p>
    </div>

</div>
@endsection

@section('js')
    <script src="{{ asset('js/imageModal.js') }}"></script>
    <script src="{{ asset('js/emailModal.js') }}"></script>
@endsection