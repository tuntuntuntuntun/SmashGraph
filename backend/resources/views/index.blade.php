@extends('layouts.app')

@section('content')
<form action="{{ route('inputData') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="fighter">ファイター名</label>
        <input type="text" name="fighter" class="form-control" id="fighter"　placeholder="マリオ">
        <small class="form-text text-muted">Miiファイターはそれぞれ格ミ・剣ミ・シャゲミと入力してください</small>
    </div>
    <div class="form-group">
        <label for="power">世界戦闘力</label>
        <input type="number" name="power" class="form-control" id="power" placeholder="7000000">
    </div>
    <button type="submit" class="btn btn-primary">送信</button>
</form>

<h2>グラフが作成されているファイターの一覧</h2>
<!-- 検索 -->
<form action="{{ route('index') }}" method="get">
    <input type="text" name="search">
    <input type="submit" value="検索">
</form>

@foreach($fighters as $fighter)
    <form action="{{ route('graph') }}" method="get">
        <input type="hidden" name="fighter" value="{{ $fighter->fighter }}">
        <input type="hidden" name="search" value="true">
        <button type="submit">{{ $fighter->fighter }}</button>
    </form>
@endforeach
@endsection