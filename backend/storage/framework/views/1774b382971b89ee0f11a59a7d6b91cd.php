

<?php $__env->startSection('title', 'Добавить сотрудника'); ?>

<?php $__env->startSection('content'); ?>

  <form action="<?php echo e(route('employee.store')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <h3>Добавить сотрудника</h3>

    <?php echo $__env->make('employees.parts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <button type="submit" class="btn btn-outline-primary">Сохранить</button>
  </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/employees/create.blade.php ENDPATH**/ ?>