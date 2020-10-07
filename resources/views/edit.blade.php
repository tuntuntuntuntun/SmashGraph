@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $fighter }}のデータを編集する</h1>
    <form aciton="{{ route('edit') }}" method="post" class="mt-5">
        @csrf
        @for($i = 0; $i < count($specific_fighter); $i++)
            <div class="form-group">
                <label for="{{ $specific_fighter[$i]->created_at }}">世界戦闘力:{{ $specific_fighter[$i]->power }} 作成日時:{{ $specific_fighter[$i]->created_at }}</label>
                <input type="number" name="power[{{ $i }}]" class="form-control" id="{{ $specific_fighter[$i]->created_at }}" placeholder="世界戦闘力を入力する">
                <input type="hidden" name="created_at[{{ $i }}]" value="{{ $specific_fighter[$i]->created_at }}">
                <input type="hidden" name="count" value="{{ count($specific_fighter) }}">
            </div> 
        @endfor
        <button type="submit" class="btn btn-primary mt-4">更新する</button>
    </form>
</div>
@endsection