@extends('layouts/app')

@section('title')
    My Notes
@endsection

@section('styles')
    <style>
        h1 {
            color: red;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>My Notes</h1>
        <a href="{{ route('notes.create') }}" class="btn btn-primary">Create new Note</a>
    </div>
    <hr>

    @if(count(Auth::user()->notes))
        @foreach(Auth::user()->notes as $note)
            <p>{{ $note->content }}</p>

            <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-info">Edit</a>
            <a href="{{ route('notes.delete', $note->id) }}" class="btn btn-danger">Delete</a>
        @endforeach
    @else
        <p style="font-size: 20px">There's no notes in our database, <a href="{{ route('notes.create') }}">Create new</a></p>
    @endif

@endsection
