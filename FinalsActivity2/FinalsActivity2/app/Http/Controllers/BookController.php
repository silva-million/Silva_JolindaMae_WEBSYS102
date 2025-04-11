<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // READ METHOD
    public function index(){
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create(){
        return view('books.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_date' => 'required|date',
        ]);

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'published_date' => $request->published_date,
        ]);

        return redirect()->route('books.index');
    }

    //UPDATE METHOD
    public function edit($id){
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_date' => 'required|date',
        ]);

        $book = Book::findOrFail($id);
        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'published_date' => $request->published_date,
        ]);

        return redirect()->route('books.index');
    }

    //DELETE METHOD
    public function destroy($id){
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index');
    }
}
