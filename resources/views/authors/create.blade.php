@extends('layouts/app')

@section('title')
    Create Author
@endsection


@section('content')
    @include('inc/errors')

    <form method="POST" action="{{ route('storeAuthors') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="name">
        </div>
        <div class="form-group">
        <textarea class="form-control" rows="3" name="bio" placeholder="biography">{{ old('bio') }}</textarea>
        </div>
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="customFile" name="img">
            <label class="custom-file-label" for="customFile">Choose image</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
