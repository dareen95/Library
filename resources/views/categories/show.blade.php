@extends('layouts/app')

@section('title')
    Show Category {{ $category->id }}
@endsection

@section('content')
    <h1>Category ID: {{ $category->id }}</h1>
    <hr>

    <h3>{{ $category->name }}</h3>

    <p class="mb-0">Books:</p>
    <ul>
        @if(count($category->books) > 0)
            @foreach ($category->books as $book)
            <li>
                <a href="{{ route('showBooks', $book->id) }}">
                    {{ $book->name }}
                </a>
            </li>
            @endforeach
        @else
            <p>There is no book yet</p>
        @endif
    </ul>

    <hr>

    <a href="{{ route('categories.index') }}">Show all categories</a>


@endsection
