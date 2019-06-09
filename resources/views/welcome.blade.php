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

    <div class="modal fade trans-white-background" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content trans-white-background p-5">
                <form action="/email" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="emailName">Your Name:</label>
                        <input type="text" name="name" class="form-control" id="emailName" placeholder="John Doe" required>
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">Reply Email:</label>
                        <input type="email" name="email" class="form-control" id="emailAddresss" placeholder="John@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="emailSubject">Subject:</label>
                        <input type="text" name="subject" class="form-control" id="emailSubject" placeholder="I Love Your Pins!" required>
                    </div>
                    <div class="form-group">
                        <label for="emailMessage">Your Message:</label>
                        <textarea name="message" class="form-control" id="emailMessage" rows="10" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-info btn-block">Send Message</button>
                    <button type="submit" class="btn btn-outline-secondary btn-block" id="cancelSendEmail" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    {{$posts->links()}}

    <hr>

    <div class="d-flex-justify-content-center">
        <p class="text-muted text-center"><small>Copyright © {{date('Y')}} Liz Masters</small></p>
    </div>

</div>
@endsection

@section('js')
    <script src="{{ asset('js/imageModal.js') }}"></script>
@endsection

