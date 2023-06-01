

<?php $__env->startSection('title', 'Главная страница'); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('categories.parts.categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Comp\second_degree\jh\52_медкорт\projects\library-laravel\resources\views/categories/index.blade.php ENDPATH**/ ?>