<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::orderBy('id', 'DESC');

        return view('notes.index', compact('notes'));
        // return view('categories.index', [ 
        //     'categories' => $categories
        // ]);
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        //validation
        $request->validate([
            'content' => 'required|string',
        ]);
        // dd($request);

        Note::create([
            'content' => $request->content,
            'user_id' => Auth::user()->id,
        ]);
        return redirect( route('notes.index') );

    }

    public function edit($id)
    {
        $note = Note::findOrFail($id);

        return view('notes.edit',[
            'note' => $note
        ]);
    }

    public function update($id, Request $request)
    {
        //validation
        $request->validate([
            'content' => 'required|string'
        ]);

        $note = Note::findOrFail($id);

        $note->update([
            'content' => $request->content,
            'user_id' => Auth::user()->id,
        ]);
        return redirect( route('notes.index', $id) );
    }

    public function delete($id)
    {
        $note = Note::findOrFail($id);
            
        $note->delete();

        return redirect( route('notes.index') );
    }
}
