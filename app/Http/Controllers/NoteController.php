<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $note = new Note;
        $note -> user_id    = Auth::User()->id;
        $note -> note  = $request -> note_text;
        $note -> save();
        return redirect('note/show');
    }

    public function show(Note $note)
    {
        $notes = Note::where('user_id',Auth::User()->id)
         ->orderBy('updated_at', 'desc')
         ->paginate(10);
        return view('note.show',['notes'=>$notes]);
    }

    public function edit(Request $request)
    {
        $note =Note::find($request -> note_id);
        $note -> note  =  $request -> note_text;
        $note -> save();
        return redirect('note/show');
    }

    public function destroy(Note $note)
    {
        $this->authorize('destroy', $note);
        $note = Note::find($note->id);
        $note->delete();
        return redirect('note/show');
    }
}
