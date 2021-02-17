@extends('layouts/app')

@section('title')
    Search results
@endsection

@section('content')

    <h1>Search results</h1>

    @foreach($authors as $author)

        <hr>
        @if ($author->img !== null)
            <img src='{{ asset("uploads/$author->img") }}' width="100" height="100">
        @endif
        <h2>{{ $author->name }}</h2>
        <p>{{ $author->bio }}</p>

    @endforeach


@endsection


