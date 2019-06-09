@extends('layouts.app')

@section('style')
    <style>
        .trans-background {
            background-color: rgba(245, 245, 245, .8);
        }
    </style>    
@endsection

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

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="d-flex flex-column trans-background py-1 px-3 rounded" style="width: 32rem;">
                <h1 class="modal-title d-flex justify-content-center">
                    <span class="text-center px-5" id="modalTitle"></span>
                </h1>
                <img id="modalImage" src="" class="card-img-top my-2">
                <p class="d-flex justify-content-center text-center px-5">
                    <small>
                        <span class="" id="modalDescription"></span>
                    </small>
                </p>
            </div>
        </div>
    </div>

    {{$posts->links()}}

</div>
@endsection

@section('js')
<script>
    $(function() {
        $('#imageModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            $('#modalImage').attr("src", button.data('path'));
            $('#modalTitle').html(button.data('title'));
            $('#modalDescription').html(button.data('description'));
        });
    });
</script>
@endsection

