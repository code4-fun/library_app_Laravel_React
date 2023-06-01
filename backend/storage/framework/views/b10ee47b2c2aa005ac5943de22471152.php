

<?php $__env->startSection('title', $book->title); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('books.parts.book', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/books/show.blade.php ENDPATH**/ ?>