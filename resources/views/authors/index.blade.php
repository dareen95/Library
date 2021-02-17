@extends('layouts/app')

@section('title')
    All Authors
@endsection

@section('styles')
    <style>
        h1 {
            color: red;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>All Authors</h1>
        @auth
            @if(Auth::user()->role == 'admin')
                <a href="{{ route('createAuthors') }}" class="btn btn-primary">Create new author</a>
            @endif
        @endauth
    </div>

    <hr>
    @if(count($authors))
        @foreach($authors as $author)
            @if ($author->img !== null)
                <img src='{{ asset("uploads/$author->img") }}' width="100" height="100">
            @endif
            <a href="{{ route('showAuthor', $author->id) }}">
                <h2>{{ $author->name }}</h2>
            </a>
            <p>{{ $author->bio }}</p>
            <a href="{{ route('showAuthor', $author->id) }}" class="btn btn-primary">Show</a>
            @auth
                @if(Auth::user()->role == 'admin')
                    <a href="{{ route('editAuthors', $author->id) }}" class="btn btn-info">Edit</a>
                    <a href="{{ route('deleteAuthors', $author->id) }}" class="btn btn-danger">Delete</a>
                @endif
            @endauth
        @endforeach
    @else
        <p style="font-size: 20px">There's no authors in our database
            @auth
                @if(Auth::user()->role == 'admin')
                    , <a href="{{ route('createAuthors') }}">Create new</a>
                @endif
            @endauth
        </p>
    @endif

    <div class="my-5">
        {!! $authors->render() !!} <!-- parser to HTML  -->
    </div>
@endsection
