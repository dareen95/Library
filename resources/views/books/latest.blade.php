@extends('layouts/app')

@section('title')
    Latest books
@endsection

@section('content')
    <h1>Latest books</h1>

    @foreach ($books as $book)

        <hr>
        @if ($book->img !== null)
            <img src='{{ asset("uploads/$book->img") }}' width="100" height="100">
        @endif
        <h2>{{$book->id}} - {{$book->name}}</h2>
        <p>{{$book->bio}}</p>
        <small>{{$book->created_at}}</small>

    @endforeach
@endsection
