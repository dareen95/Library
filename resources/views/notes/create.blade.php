@extends('layouts/app')

@section('title')
    Create Note
@endsection


@section('content')
    @include('inc/errors')
    
    <form method="POST" action="{{ route('notes.store') }}">
        @csrf
        <div class="form-group">
            <textarea class="form-control" rows="6" name="content" placeholder="Note">{{ old('content') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
@endsection