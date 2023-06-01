

<?php $__env->startSection('title', 'Редактировать сотрудника'); ?>

<?php $__env->startSection('content'); ?>

  <form action="<?php echo e(route('employee.update', ['id' => $employee->id])); ?>" method="post">
    <?php echo csrf_field(); ?>
    <?php echo method_field('patch'); ?>
    <h3>Редактировать сотрудника</h3>

    <?php echo $__env->make('employees.parts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <button type="submit" class="btn btn-outline-primary save_employee_button">Сохранить</button>
  </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/employees/edit.blade.php ENDPATH**/ ?>