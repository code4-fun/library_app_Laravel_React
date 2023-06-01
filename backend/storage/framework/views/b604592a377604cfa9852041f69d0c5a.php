

<?php $__env->startSection('title', 'Главная страница'); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('books.parts.pages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/books/index.blade.php ENDPATH**/ ?>