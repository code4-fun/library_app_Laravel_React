

<?php $__env->startSection('title', 'Редактировать категорию'); ?>

<?php $__env->startSection('content'); ?>

    <form action="<?php echo e(route('categories.update', ['slug' => $category->slug])); ?>" method="post">
        <?php echo csrf_field(); ?>
        <?php echo method_field('patch'); ?>
        <h3>Редактировать категорию</h3>

        <?php echo $__env->make('categories.parts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <button type="submit" class="btn btn-outline-primary">Сохранить</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Comp\second_degree\jh\52_медкорт\projects\library-laravel\resources\views/categories/edit.blade.php ENDPATH**/ ?>