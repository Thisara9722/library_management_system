<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function getBooks()
    {
        $books = Book::all();

        return $books;
    }

    /**
     * Display the book add form.
     */
    public function addBook()
    {
        return view('books.book_add');
    }


    /**
     * Display the book edit form.
     */
    public function edit($id)
    {
        $book = Book::find($id);

        return view('books.book_edit', compact('book'));
    }

    /**
     * Update book information.
     */
    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
        ]);

        // Find the book by its ID
        $book = Book::findOrFail($request->id);

        // Update the book with the new data
        $book->update([
            'name' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
        ]);

        // Optionally, you can redirect the user to a specific page after successful update
        return redirect()->route('dashboard')->with('success', 'Book updated successfully!');

    }

    /**
     * Delete book.
     */
    public function destroy($id)
    {
        $member = Book::findOrFail($id); // Find the member by ID
        $member->delete(); // Delete the member

        // Optionally, you can redirect the user to a specific page after successful deletion
        return redirect()->route('dashboard')->with('success', 'Member deleted successfully!');

    }

    /**
     * Add the book.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
        ]);

        // Create a new book instance with validated data
        $book = new Book();
        $book->name = $validatedData['title'];
        $book->author = $validatedData['author'];
        $book->genre = $validatedData['genre'];

        // Save the book to the database
        $book->save();

        // Optionally, you can redirect the user to a specific page after successful book creation
        return redirect()->route('dashboard')->with('success', 'Book added successfully!');
    }
}
