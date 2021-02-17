@extends('layouts/app')

@section('title')
    Edit Category - {{ $category->name }}
@endsection


@section('content')
    @include('inc/errors')

    <form method="POST" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="name" value="{{ old('name') ?? $category->name }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <a href="{{ route('categories.index') }}" class="btn btn-primary mt-5">Back to categories</a>
@endsection
