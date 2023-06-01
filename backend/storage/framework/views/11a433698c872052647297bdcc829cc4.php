

<?php $__env->startSection('title', $book->title); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('books.parts.book', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Comp\second_degree\jh\52_медкорт\projects\library-laravel\resources\views/books/show.blade.php ENDPATH**/ ?>