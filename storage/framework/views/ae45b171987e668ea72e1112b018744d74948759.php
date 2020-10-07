<?php $__env->startSection('content'); ?>
<div class="container">
    <canvas id="myChart" width="400" height="300"></canvas>

    <div class="d-flex justify-content-around mt-5 mb-3">
        <!-- ファイター情報を送信する -->
        <form action="<?php echo e(route('delete')); ?>" method="get">
            <input type="hidden" name="fighter" value="<?php echo e($fighter); ?>">
            <button type="submit" class="btn btn-primary">データの削除はこちら</button>
        </form>

        <form action="<?php echo e(route('edit')); ?>" method="get">
            <input type="hidden" name="fighter" value="<?php echo e($fighter); ?>">
            <button type="submit" class="btn btn-primary">データの編集はこちら</button>
        </form>
    </div>
    <form action="<?php echo e(route('tweet')); ?>" method="get" class="text-center">
        <input type="hidden" name="fighter" value="<?php echo e($fighter); ?>">
        <input type="hidden" name="power" value="<?php echo e($power); ?>">
        <button type="submit" class="btn btn-outline-primary w-75"><?php echo e(json_decode($fighter)); ?>の最新の世界戦闘力をツイートする</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    //JSONデコード
    var fighter = JSON.parse('<?= $fighter; ?>');
    var power = JSON.parse('<?= $power; ?>');
    var created_at = JSON.parse('<?= $created_at; ?>');
</script>
<!-- ChartJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="<?php echo e(asset('/js/graph.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/graph.blade.php ENDPATH**/ ?>