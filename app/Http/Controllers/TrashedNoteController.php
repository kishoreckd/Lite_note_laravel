<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class TrashedNoteController extends Controller
{

    public function index()
    {
        /**Relation method on note.php and user.php
         * */
         $notes = Note::whereBelongsTo(Auth::user())->onlyTrashed()
         ->latest('updated_at')->paginate(5);
        //View
        return view('layouts.notes.index')->with('notes', $notes);
    }

    public function show(Note $note){
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }

        return view('layouts.notes.show')->with('note',$note);
    }

    public function update(Note $note) {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        $note->restore();
        return to_route('notes.show',$note)->with('success','Note Restored');
    }

    public function destroy(Note $note) {
        if (!$note->user->is(Auth::user())) {
            return abort(403);
        }
        $note->forceDelete();
        return to_route('trashed.index',$note)->with('success','Note deleted Forever');
    }
}
