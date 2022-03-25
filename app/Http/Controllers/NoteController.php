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
        try{
            $note = new Note;
            $note -> user_id    = Auth::User()->id;
            $note -> note  = $request -> note_text;
            $note -> save();
        }catch(\Exception $e){
            $e->getMessage();
        }

        return redirect('note/show');
    }

    public function show(Note $note)
    {
        try{
            $notes = Note::where('user_id',Auth::User()->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        }catch(\Exception $e){
            $e->getMessage();
        }

        return view('note.show',['notes'=>$notes]);
    }

    public function edit(Request $request)
    {
        try{
            $note =Note::find($request -> note_id);
            $note -> note  =  $request -> note_text;
            $note -> save();
        }catch(\Exception $e){
            $e->getMessage();
        }

        return redirect('note/show');
    }

    public function destroy(Note $note)
    {
        try{
            $this->authorize('destroy', $note);
            $note = Note::find($note->id);
            $note->delete();
        }catch(\Exception $e){
            $e->getMessage();
        }

        return redirect('note/show');
    }
}
