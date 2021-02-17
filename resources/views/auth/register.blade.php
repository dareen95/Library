@extends('layouts.app')

@section('title')
    Register
@endsection

@section('content')

    @include('inc.errors')

    <form method="POST" action="{{ route('auth.handleRegister') }}">

        @csrf

        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" value="{{ old('password') }}">
        </div>

        <button type="submit" class="btn btn-primary">Register</button>

    </form>

    <a href="{{ route('auth.github.redirect') }}" class="btn btn-primary mt-4">Continue with github</a>
    <a href="{{ route('message') }}" class="float-right btn btn-success mt-4">Send Message</a>



@endsection
