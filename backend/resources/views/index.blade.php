@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
    <form action="{{ route('inputData') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="fighter">ファイター名</label>
            <input type="text" name="input_fighter" class="form-control" id="fighter"　placeholder="マリオ">
            <small class="form-text text-muted">Miiファイターはそれぞれ格ミ・剣ミ・シャゲミと入力してください</small>
        </div>
        <div class="form-group">
            <label for="power">世界戦闘力</label>
            <input type="number" name="input_power" class="form-control" id="power" placeholder="7000000">
        </div>
        <button type="submit" class="btn btn-primary">送信</button>
    </form>

    <h2 class="mt-5 h3">グラフが作成されているファイターの一覧</h2>
    <!-- 検索 -->
    <form action="{{ route('index') }}" method="get" class="mt-4">
        <div class="form-group">
            <input type="text" name="keyword"　placeholder="キーワード">
            <input type="submit" value="検索">
        </div>
    </form>

    <div class="d-flex flex-wrap">
        @foreach($fighters as $fighter)
            <form action="{{ route('graph') }}" method="get" class="mr-2 mb-2">
                <input type="hidden" name="fighter" value="{{ $fighter->fighter }}">
                <input type="hidden" name="search" value="true">
                <button type="submit" class="btn btn-secondary">{{ $fighter->fighter }}</button>
            </form>
        @endforeach
    </div>
</div>
@endsection