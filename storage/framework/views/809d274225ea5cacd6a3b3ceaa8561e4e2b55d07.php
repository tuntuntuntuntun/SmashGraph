<?php $__env->startSection('content'); ?>
<div class="container">
    <h1><?php echo e($fighter); ?>のデータを削除する</h1>
    <form aciton="<?php echo e(route('delete')); ?>" method="post" class="mt-5">
        <?php echo csrf_field(); ?>
        <?php $__currentLoopData = $specific_fighter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="delete_record" id="<?php echo e($sf->created_at); ?>" value="<?php echo e($sf->created_at); ?>">
                <label class="form-check-label" for="<?php echo e($sf->created_at); ?>">世界戦闘力:<?php echo e($sf->power); ?> 作成日時:<?php echo e($sf->created_at); ?></label>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">削除する</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/delete.blade.php ENDPATH**/ ?>