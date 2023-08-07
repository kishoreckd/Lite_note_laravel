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
        $notes=Note::where('user_id',Auth::id())->paginate(5);
        //View
        return view('layouts.notes.index')->with('notes',$notes);

        //looping data from db
        // $notes->each(function ($note){
        //     // dump($note->title);
        // });

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
            'title'=>'required|max:120',
            'text'=>'required'
        ]);

        // dd(Auth::id());

        //Old method
        // $note= new Note([
        //     'user_id'=>Auth::id(),
        //     'title'=>$request->title,
        //     'text'=>$request->text

        // ]);

        // $note->save();

        Note::create([
            'uuid'=>Str::uuid(),
            'user_id'=>Auth::id(),
            'title'=>$request->title,
            'text'=>$request->text

        ]);
        return to_route('notes.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if ($note->user_id != Auth::id()) {
            # code...
            return abort(403);
        }
        //
        return view('layouts.notes.show')->with('note',$note);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
