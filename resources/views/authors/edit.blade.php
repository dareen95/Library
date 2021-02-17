@extends('layouts/app')

@section('title')
    Edit Author - {{ $author->name }}
@endsection


@section('content')
    @include('inc/errors')

    <form method="POST" action="{{ route('updateAuthors', $author->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="name" value="{{ $author->name }}">
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="3" name="bio" placeholder="biography">{{ $author->bio }}</textarea>
        </div>
        @if ($author->img !== null)
            <img src='{{ asset("uploads/$author->img") }}' class="img-fluid">
        @endif

        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="customFile" name="img">
            <label class="custom-file-label" for="customFile">Edit image</label>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <a href="{{ route('allAuthors') }}" class="btn btn-primary mt-5">Back to all</a>
@endsection
