<?php $__env->startSection('content'); ?>
<div class="container">
    <?php if($errors->any()): ?>
	    <div class="alert alert-danger">
	        <ul>
	            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                <li><?php echo e($error); ?></li>
	            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	        </ul>
	    </div>
	<?php endif; ?>
    <form action="<?php echo e(route('inputData')); ?>" method="post">
        <?php echo csrf_field(); ?>
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

    <h2 class="mt-5">グラフが作成されているファイターの一覧</h2>
    <!-- 検索 -->
    <form action="<?php echo e(route('index')); ?>" method="get" class="mt-4">
        <div class="form-group">
            <input type="text" name="keyword"　placeholder="キーワード">
            <input type="submit" value="検索">
        </div>
    </form>

    <div class="d-flex flex-wrap">
        <?php $__currentLoopData = $fighters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fighter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <form action="<?php echo e(route('graph')); ?>" method="get" class="mr-2 mb-2">
                <input type="hidden" name="fighter" value="<?php echo e($fighter->fighter); ?>">
                <input type="hidden" name="search" value="true">
                <button type="submit" class="btn btn-secondary"><?php echo e($fighter->fighter); ?></button>
            </form>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/index.blade.php ENDPATH**/ ?>