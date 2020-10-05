@extends('layouts.app')

@section('content')
<canvas id="myChart" width="400" height="300"></canvas>

<!-- ファイター情報を送信する -->
<form action="{{ route('delete') }}" method="get">
    <input type="hidden" name="fighter" value="{{ $fighter }}">
    <button type="submit" class="btn btn-primary">データの削除はこちら</button>
</form>
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