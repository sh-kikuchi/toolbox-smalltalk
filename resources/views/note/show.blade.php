@extends('layouts.app')
@section('content')

<div>
<h2>ひとりごと</h2>
<h5 class="pl-4">使い方は自由。todoリストやメモなどにお役立て下さい。</h5>
</div>
<form method="POST" action="{{ route('note.store') }}">
{{ csrf_field() }}
<div class="form-group row">
    <input class="form-control col-8 col-sm-10 ml-3" type="text" name = "note_text" placeholder="ひとりごとは200字でお願いします" maxlength="200" required>
    <button type="submit" class="btn btn-secondary col-2 col-sm-1 ml-2"><i class="far fa-paper-plane"></i></button>
</div>
</form>
@foreach($notes as $note)
<div class="media shadow-sm p-3 mb-1 bg-white rounded">
    <div class="media-body px-1 text-break">
        {{ $note -> note }}
        <div class="float-right">
            <!-- Button trigger modal -->
            <button type="submit" class="btn btn-primary js-modal-open" href="" data-target="note-modal" data-note_id="{{$note->id}}" data-note_text="{{ $note-> note }}"><i class="fas fa-pen"></i></button>
            <a class="btn btn-danger"  onclick="return confirm('このカードを削除して良いですか?')" rel="nofollow" data-method="delete" href="/note/destroy/{{ $note->id }}"><i class="far fa-trash-alt"></i></a>
        </div>
    </div>
</div>
@endforeach

<div class="d-flex justify-content-center py-4">
{{ $notes->links() }}
</div>

@endsection
