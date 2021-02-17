<?php

namespace App\Http\Controllers;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiBookController extends Controller
{
    public function index()
    {
        $books = Book::with('author', 'categories')->get();
        // $books = Book::select('id', 'name')->get();

        return response()->json($books);
    }

    public function show($id)
    {
        $book = Book::with('author', 'categories')->findOrFail($id);

        return response()->json($book);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'desc' => 'required|string',
            'img' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'price' => 'required|numeric|max:999999.99',
            'author_id' => 'required|exists:authors,id', //for check the id is inside database or not
            'category_ids' => 'required',
            'category_ids.*' => 'exists:categories,id' //mwgoda fel table categories fel column id
        ]);

        if ($validator->fails())
        {
           $errors = $validator->errors();
            return response()->json($errors);
        }

        $img = $request->img; //or $request->file('img');
        $ext = $img->getClientOriginalExtension();
        $name = "book-" . uniqid() . ".$ext";
        $img->move( public_path('uploads'), $name );

        $book = Book::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'img' => $name,
            'price' => $request->price,
            'author_id' => $request->author_id
        ]);
        $book->categories()->sync($request->category_ids);

        $success = "Book created successfully";
        return response()->json($success);
    }

    public function update($id, Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'desc' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'price' => 'required|numeric|max:999999.99',
            'author_id' => 'required|exists:authors,id',
            'category_ids' => 'required',
            'category_ids.*' => 'exists:categories,id'
        ]);

        if ($validator->fails())
        {
           $errors = $validator->errors();
            return response()->json($errors);
        }

        $book = Book::findOrFail($id);
        $name = $book->img;

        if($request->hasFile('img'))
        {
            if($name !== null)
            {
                unlink( public_path("uploads/$name") );
            }

            $img = $request->img; //or file('img');
            $ext = $img->getClientOriginalExtension();
            $name = "book-" . uniqid() . ".$ext";
            $img->move( public_path('uploads'), $name );
        }

        $book->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'img' => $name,
            'price' => $request->price,
            'author_id' => $request->author_id
        ]);

        $book->categories()->sync($request->category_ids);

        $success = "Book updated successfully";
        return response()->json($success);
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);

        $name = $book->img;
        if($name !== null)
        {
            unlink( public_path("uploads/$name") );
        }

        $book->delete();

        $success = "Book deleted successfully";
        return response()->json($success);
    }
}
