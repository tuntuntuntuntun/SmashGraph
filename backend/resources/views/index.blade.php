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

<!-- <form action="" method="post"> -->
<!-- ファイター選択フォームを作成し、その値を元に/graphへ飛ばす -->
<!-- fighter_poewrsから情報を取得し、存在するファイターのみを表示 -->
<!-- </form> -->
@endsection