@extends('layouts/app')

@section('title')
    Search results
@endsection

@section('content')

    <h1>Search results</h1>

    @foreach($books as $book)

        <hr>
        @if ($book->img !== null)
            <img src='{{ asset("uploads/$book->img") }}' width="100" height="100">
        @endif
        <h2>{{ $book->name }}</h2>
        <p>{{ $book->bio }}</p>

    @endforeach


@endsection


