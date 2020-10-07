<?php $__env->startSection('content'); ?>
<div class="container">
    <h1><?php echo e($fighter); ?>のデータを編集する</h1>
    <form aciton="<?php echo e(route('edit')); ?>" method="post" class="mt-5">
        <?php echo csrf_field(); ?>
        <?php for($i = 0; $i < count($specific_fighter); $i++): ?>
            <div class="form-group">
                <label for="<?php echo e($specific_fighter[$i]->created_at); ?>">世界戦闘力:<?php echo e($specific_fighter[$i]->power); ?> 作成日時:<?php echo e($specific_fighter[$i]->created_at); ?></label>
                <input type="number" name="power[<?php echo e($i); ?>]" class="form-control" id="<?php echo e($specific_fighter[$i]->created_at); ?>" placeholder="世界戦闘力を入力する">
                <input type="hidden" name="created_at[<?php echo e($i); ?>]" value="<?php echo e($specific_fighter[$i]->created_at); ?>">
                <input type="hidden" name="count" value="<?php echo e(count($specific_fighter)); ?>">
            </div> 
        <?php endfor; ?>
        <button type="submit" class="btn btn-primary mt-4">更新する</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/edit.blade.php ENDPATH**/ ?>