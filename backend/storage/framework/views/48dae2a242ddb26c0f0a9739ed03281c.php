

<?php $__env->startSection('title', 'Редактировать книгу'); ?>

<?php $__env->startSection('content'); ?>

  <form action="<?php echo e(route('book.update', ['slug' => $book->slug])); ?>" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('patch'); ?>
    <h3>Редактировать книгу</h3>

    <?php echo $__env->make('books.parts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <button type="submit" class="btn btn-outline-primary">Сохранить</button>
  </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/books/edit.blade.php ENDPATH**/ ?>