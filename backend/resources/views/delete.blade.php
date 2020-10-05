@extends('layouts.app')

@section('content')
<h3>{{ $fighter }}のデータを削除する</h3>
<form aciton="{{ route('delete') }}" method="post">
    @csrf
    @foreach($delete_fighter as $df)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="delete_record" id="{{ $df->created_at }}" value="{{ $df->created_at }}">
            <label class="form-check-label" for="{{ $df->created_at }}">世界戦闘力:{{ $df->power }} 作成日時:{{ $df->created_at }}</label>
        </div>
    @endforeach
    <div class="form-group">
        <button type="submit" class="btn btn-primary">削除する</button>
    </div>
</form>
@endsection