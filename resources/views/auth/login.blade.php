@extends('layouts.app')

@section('title')
    Login
@endsection

@section('content')

    @include('inc.errors')

    <form method="POST" action="{{ route('auth.handleLogin') }}">
        @csrf

        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" value="{{ old('password') }}">
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <a href="{{ route('auth.github.redirect') }}" class="btn btn-primary mt-4">Login in with Github</a>
    <a href="{{ route('auth.facebook.redirect') }}" class="btn btn-primary mt-4">Login in with Facebook</a>
    <a href="{{ route('auth.google.redirect') }}" class="btn btn-primary mt-4">Login in with Google</a>
    <a href="{{ route('message') }}" class="float-right btn btn-success mt-4">Send Message</a>

@endsection



