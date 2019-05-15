@extends('layouts.auth')

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection

@section('content')
    <form method="POST" action="{{ route('login') }}" class="form-signin">
        @csrf

        <img class="mb-4" src="" alt="" width="72" height="72">

        <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>

        <label for="email" class="sr-only">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="password" class="sr-only">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div class="checkbox mb-3">
            <label class="form-check-label" for="remember">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
            </label>
        </div>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

    </form>
@endsection
