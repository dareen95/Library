@extends('layouts/app')

@section('title')
    Edit Book - {{ $book->name }}
@endsection


@section('content')
    @include('inc/errors')

    <form method="POST" action="{{ route('Books.update', $book->id) }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') ?? $book->name }}">
        </div>

        <div class="form-group">
            <textarea class="form-control" rows="8" name="desc" placeholder="Description">{{ old('desc') ?? $book->desc }}</textarea>
        </div>

        <div class="form-group">
            <input type="number" class="form-control" name="price" placeholder="Price" value="{{ old('price') ?? $book->price }}">
        </div>

        <select class="custom-select" name="author_id">
            @foreach ($authors as $author)
                <option value="{{ $author->id }}" @if($author->id == $book->author_id) selected @endif >
                    {{ $author->name }}
                </option>
            @endforeach
        </select>

        @if ($book->img !== null)
            <img src='{{ asset("uploads/$book->img") }}' class="img-fluid mt-3">
        @endif

        <div class="custom-file my-3">
            <input type="file" class="custom-file-input" id="customFile" name="img">
            <label class="custom-file-label" for="customFile">Edit image</label>
        </div>

        <h6 class="mb-0">Select Categories:</h6>
        @foreach ($categories as $category)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="category_ids[]" value="{{ $category->id }}" id="defaultCheck1"
                @foreach($book->categories as $book->category)
                    @if($category->id == $book->category->id)
                        checked
                    @endif
                @endforeach>
                <label class="form-check-label" for="defaultCheck1">
                    {{ $category->name }}
                </label>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>

    <a href="{{ route('allBooks') }}" class="btn btn-primary mt-5">Back</a>
@endsection
