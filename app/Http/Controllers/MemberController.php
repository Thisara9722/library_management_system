<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('members');
    }

    /**
     * Display a listing of the resource.
     */
    public function getMembers()
    {
        $members = Member::all();

        return $members;
    }

    /**
     * Add new member.
     */
    public function addMember()
    {
        return view('members.member_add');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'national_id' => 'required|string|max:12',
        ]);

        // Create a new book instance with validated data
        $member = new Member();
        $member->name = $validatedData['name'];
        $member->national_id = $validatedData['national_id'];


        // Save the book to the database
        $member->save();

        // Optionally, you can redirect the user to a specific page after successful book creation
        return redirect()->route('members')->with('success', 'Member added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Display the memeber edit form.
     */
    public function edit($id)
    {
        $member = Member::find($id);

        return view('members.member_edit', compact('member'));
    }

    /**
     * Update member information.
     */
    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'national_id' => 'required|string|max:12',
        ]);

        // Find the book by its ID
        $book = Member::findOrFail($request->id);

        // Update the book with the new data
        $book->update([
            'name' => $request->name,
            'national_id' => $request->national_id,
        ]);

        // Optionally, you can redirect the user to a specific page after successful update
        return redirect()->route('members')->with('success', 'Member updated successfully!');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id); // Find the member by ID
        $member->delete(); // Delete the member

        // Optionally, you can redirect the user to a specific page after successful deletion
        return redirect()->route('members')->with('success', 'Member deleted successfully!');
    }
}
