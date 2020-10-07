@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $fighter }}のデータを削除する</h1>
    <form aciton="{{ route('delete') }}" method="post" class="mt-5">
        @csrf
        @foreach($specific_fighter as $sf)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="delete_record" id="{{ $sf->created_at }}" value="{{ $sf->created_at }}">
                <label class="form-check-label" for="{{ $sf->created_at }}">世界戦闘力:{{ $sf->power }} 作成日時:{{ $sf->created_at }}</label>
            </div>
        @endforeach
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">削除する</button>
        </div>
    </form>
</div>
@endsection