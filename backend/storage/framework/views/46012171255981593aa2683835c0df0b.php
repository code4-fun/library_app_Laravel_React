

<?php $__env->startSection('title', 'Добавить книгу'); ?>

<?php $__env->startSection('content'); ?>

  <form action="<?php echo e(route('book.store')); ?>" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <h3>Добавить книгу</h3>

    <?php echo $__env->make('books.parts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <button type="submit" class="btn btn-outline-primary">Сохранить</button>
  </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/books/create.blade.php ENDPATH**/ ?>