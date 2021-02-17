@extends('layouts/app')

@section('title')
    Show author {{ $author->id }}
@endsection

@section('content')
    @if ($author->img !== null)
        <img src='{{ asset("uploads/$author->img") }}' class="img-fluid">
    @endif
    <h1>Show author {{ $author->id }}</h1>
    <hr>
    <h3>{{ $author->name }}</h3>
    <p>{{ $author->bio }}</p>
    <hr>

    <h3>Books</h3>
    {{--  @if(!empty($author->books))  --}}
    @if(count($author->books) > 0)
        @foreach ($author->books as $item)
            <a href="{{ route('showBooks', $item->id) }}">
                <p>{{ $item->name }}</p>
            </a>
        @endforeach
    @else
        <p>There is no book yet</p>
    @endif

    {{--  {{ $author->books }}  --}}

    <hr>

    <a href="{{ route('allAuthors') }}">All authors</a>


@endsection
