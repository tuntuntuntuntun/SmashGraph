@extends('layouts.app')

@section('content')
<div class="container">
    <canvas id="myChart" width="400" height="300"></canvas>

    <div class="d-flex justify-content-around mt-5 mb-3">
        <!-- ファイター情報を送信する -->
        <form action="{{ route('delete') }}" method="get">
            <input type="hidden" name="fighter" value="{{ $fighter }}">
            <button type="submit" class="btn btn-primary">データの削除はこちら</button>
        </form>

        <form action="{{ route('edit') }}" method="get">
            <input type="hidden" name="fighter" value="{{ $fighter }}">
            <button type="submit" class="btn btn-primary">データの編集はこちら</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    //JSONデコード
    var fighter = JSON.parse('<?= $fighter; ?>');
    var power = JSON.parse('<?= $power; ?>');
    var created_at = JSON.parse('<?= $created_at; ?>');
</script>
<!-- ChartJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="{{ asset('/js/graph.js') }}"></script>
@endsection