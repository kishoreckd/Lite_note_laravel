<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use function Laravel\Prompts\note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //getting values from Db
        // first method
        $notes = Note::where('user_id', Auth::id())->latest('updated_at')->paginate(5);

        /**Relation method on note.php and user.php
         * */
         $notes = Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);
        //View
        return view('layouts.notes.index')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //returning view file
        return view('layouts.notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //checkong request
        // dd($request);
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        // dd(Auth::id());

        //Old method
        // $note= new Note([
        //     'user_id'=>Auth::id(),
        //     'title'=>$request->title,
        //     'text'=>$request->text

        // ]);

        // $note->save();


        /**New Method */
        // Note::create([
        //     'uuid' => Str::uuid(),
        //     'user_id' => Auth::id(),
        //     'title' => $request->title,
        //     'text' => $request->text

        // ]);

        /**It creates using Auth method */

        Auth::user()->notes()->create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'text' => $request->text

        ]);
        return to_route('notes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        // Method 1
        // if ($note->user_id != Auth::id()) {
        //     # code...
        //     return abort(403);
        // }



        /**Relation method on note.php and user.php
         * */
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        return view('layouts.notes.show')->with('note', $note);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {

        // Method 1
        // if ($note->user_id != Auth::id()) {
        //     # code...
        //     return abort(403);
        // }



        /**Relation method on note.php and user.php
         * */
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        //
        return view('layouts.notes.edit')->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
       // Method 1
        // if ($note->user_id != Auth::id()) {
        //     # code...
        //     return abort(403);
        // }



        /**Relation method on note.php and user.php
         * */
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        $note->update([
            'title' => $request->title,
            'text' => $request->text,

        ]);
        return to_route('notes.show', $note)->with('success', 'Note updated Success fully');

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
         // Method 1
        // if ($note->user_id != Auth::id()) {
        //     # code...
        //     return abort(403);
        // }



        /**Relation method on note.php and user.php
         * */
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        $note->delete();

        return to_route('notes.index')->with('Success', 'Note Moved to Trash');
        //
    }
}
