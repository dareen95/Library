<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{
    public function index()
    {
        // return 'hello index';

        // call the model to fetch all authors
        // SELECT * FROM authors
        $authors = Author::orderBy('id', 'DESC')->paginate(4);
        // select('name', 'bio')
        // ->where('id', '>', 1)
        // ->orderBy('id', 'DESC')
        // ->take(2)
        
        
        // dd($authors);

        return view('authors.index', [
            'authors' => $authors
        ]);
    }

    public function latest()
    {
        $authors = Author::orderBy('id', 'DESC')
        ->take(3)
        ->get();

        return view('authors.latest', [
            'authors' => $authors
        ]);
    }

    public function show($id)
    {
        $author = Author::find($id);

        return view('authors.show', [
            'author' => $author
        ]);
    }

    public function search($word)
    {
        // WHERE LIKE '%2%'
        $authors = Author::where('name', 'like', "%$word%")
        ->get();

        return view('authors.search', [
            'authors' => $authors
        ]);
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required|string|max:100',
            'bio' => 'required|string',
            'img' => 'required|image|mimes:jpeg,jpg,png'
        ]);
        $img = $request->img; //file('img');
        $ext = $img->getClientOriginalExtension();
        $name = "author-" . uniqid() . ".$ext";
        $img->move( public_path('uploads'), $name );

        // $request->all();
        // $name = $request->name;
        // $bio = $request->bio;

        Author::create([
            'name' => $request->name,
            'bio' => $request->bio,
            'img' => $name
        ]);
        return redirect( route('allAuthors') );

    }

    public function edit($id)
    {
        $author = Author::find($id);

        return view('authors.edit',[
            'author' => $author
        ]);
    }

    public function update($id, Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required|string|max:100',
            'bio' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,jpg,png'
        ]);

        $author = Author::find($id);
        $name = $author->img;

        if($request->hasFile('img'))
        {
            //if he uploaded new image
            if($name !== null)
                //delete the old img
                unlink( public_path("uploads/$name") ); //Delete img

            //upload the new img
            $img = $request->img; //file('img');
            $ext = $img->getClientOriginalExtension();
            $name = "author-" . uniqid() . ".$ext";
            $img->move( public_path('uploads'), $name );
        }

        $author->update([
            'name' => $request->name,
            'bio' => $request->bio,
            'img' => $name
        ]);
        // return redirect( route('editAuthors', $id) );
        return redirect( route('allAuthors') );
        // return back();
    }

    public function delete($id)
    {
        $author = Author::find($id);
        
        $name = $author->img;
        if($name !== null)
            unlink( public_path("uploads/$name") ); //Delete img
        
        $author->delete();

        return back();
    }
}
 