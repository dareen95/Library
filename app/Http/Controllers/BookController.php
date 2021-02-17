<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use App\Book;
use App\Category;

class BookController extends Controller
{
    public function index()
    {
        // call the model to fetch all books
        // $books = Book::orderBy('id', 'DESC')->paginate(4);
        $books = Book::orderBy('id', 'DESC')->get();


        // $books = Book::get(); //select all
        // $books = Book::select('name', 'desc')->get();
        // $books = Book::where('id', '>=', 2)->get();
        // $books = Book::select('name', 'desc')->where('id', '>=', 2)->get();
        // $books = Book::select('name', 'desc')->where('id', '>=', 2)->orderBy('id', 'DESC')->get();

        // return view('books.index', compact('books')); //El path bekon mn awol folder el view

        return view('books.index', [
            'books' => $books
        ]);
    }

    // public function latest()
    // {
    //     $books = Book::orderBy('id', 'DESC')
    //     ->take(3)
    //     ->get();

    //     return view('books.latest', [
    //         'books' => $books
    //     ]);
    // }

    // public function show($id)
    public function show(Book $book) //route model binding
    {
        // $books = Book::where('id', '=', 2)->first(); //Lw 3ayz ageb 7aga wa7da ba2olo arrow first aw method esmha find()

        // $book = Book::findOrFail($id); //OrFail 3shan lw ro7t l id msh mwgod ygbly error 404

        return view('books.show', [
            'book' => $book
        ]);
    }

    // public function search($word)
    // {
    //     // WHERE LIKE '%2%'
    //     $books = Book::where('name', 'like', "%$word%")
    //     ->get();

    //     return view('books.search', [
    //         'books' => $books
    //     ]);
    // }

    public function create()
    {
        $authors = Author::select('id', 'name')->get(); //bagbha mn el database 3shan astkhdemha fel dropdown
        $categories = Category::select('id', 'name')->get(); //bagbha mn el database 3shan astkhdemha fel checkbox

        return view('books.create', [
            'authors' => $authors,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required|string|max:100',
            'desc' => 'required|string',
            'img' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'price' => 'required|numeric|max:999999.99',
            'author_id' => 'required|exists:authors,id', //for check the id is inside database or not
            'category_ids' => 'required',
            'category_ids.*' => 'exists:categories,id' //mwgoda fel table categories fel column id
        ]);

        // dd($request->all());

        //move image to public >uploads folder
        $img = $request->img; //or $request->file('img');
        $ext = $img->getClientOriginalExtension();
        $name = "book-" . uniqid() . ".$ext";
        $img->move(public_path('uploads'), $name);

        //1st
        // $name = $request->name;
    // $desc = $request->desc;
        // $request->all();
        // dd($name);

        //ya model ely esmk book khazn el data fel database b method esmha create
        $book = Book::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'img' => $name, //bkhzn fel database esm el img bs
            'price' => $request->price,
            'author_id' => $request->author_id
        ]);

        $book->categories()->sync($request->category_ids);

        return redirect(route('allBooks'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();
        $selected_categories = $book->categories;

        // dd($selected_categories);

        return view('books.edit', [
            'book' => $book,
            'authors' => $authors,
            'categories' => $categories,
            'selected_categories' => $selected_categories
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'desc' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'price' => 'required|numeric|max:999999.99',
            'author_id' => 'required|exists:authors,id', //for check the id is inside database or not
            'category_ids' => 'required',
            'category_ids.*' => 'exists:categories,id'
        ]);

        $book = Book::findOrFail($id);
        $name = $book->img;

        //Lw fe image
        if ($request->hasFile('img')) {
            //if he uploaded new image
            if ($name !== null) {
                //delete the old img
                unlink(public_path("uploads/$name"));
            }

            //upload the new img
            $img = $request->img; //or file('img');
            $ext = $img->getClientOriginalExtension();
            $name = "book-" . uniqid() . ".$ext";
            $img->move(public_path('uploads'), $name);
        }

        $book->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'img' => $name,
            'price' => $request->price,
            'author_id' => $request->author_id
        ]);

        $book->categories()->sync($request->category_ids);

        // return redirect( route('Books.edit', $id) );
        return redirect(route('allBooks'));
        // return back();
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);

        $name = $book->img;
        if ($name !== null) {
            //Delete img from folder
            unlink(public_path("uploads/$name"));
        }

        // $book->categories()->sync([]);

        $book->delete();

        return back();
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $books = Book::where('name', 'like', "%$keyword%")->get();

        return response()->json($books);
    }
}
