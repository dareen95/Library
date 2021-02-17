@extends('layouts/app')

@section('title')
    Latest authors
@endsection

@section('content')
    <h1>Latest authors</h1>

    @foreach ($authors as $author)

        <hr>
        @if ($author->img !== null)
            <img src='{{ asset("uploads/$author->img") }}' width="100" height="100">
        @endif
        <h2>{{$author->id}} - {{$author->name}}</h2>
        <p>{{$author->bio}}</p>
        <small>{{$author->created_at}}</small>

    @endforeach
@endsection
