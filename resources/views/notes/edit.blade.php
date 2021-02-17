@extends('layouts/app')

@section('title')
    Edit Note - {{ $note->id }}
@endsection


@section('content')
    @include('inc/errors')

    <form method="POST" action="{{ route('notes.update', $note->id) }}">
        @csrf
        <div class="form-group">
            <textarea class="form-control" rows="6" name="content" placeholder="Note">{{ old('content') ?? $note->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <a href="{{ route('notes.index') }}" class="btn btn-primary mt-5">Back to all notes</a>
@endsection
