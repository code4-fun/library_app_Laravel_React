<div class="row">
  <h4 class="mb-3">Сотрудники</h4>

  <?php if(sizeof($employees) == 0): ?>
    <div class="col-6">
      Никого не найдено
    </div>
  <?php endif; ?>

  <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-12">
      <div class="card_custom">
        <p class="card-title"><?php echo e($employee->name); ?></p>
        <p class="card-title"><?php echo e($employee->email); ?></p>
        <div class="card_custom_buttons">
          <a href="<?php echo e(route('employee.edit', ['id' => $employee->id])); ?>" class="btn btn-outline-primary">Изменить сотрудника</a>
          <form action="<?php echo e(route('employee.destroy', ['id' => $employee->id])); ?>" method="post"
                onsubmit="return confirm('Точно удалить этого сотрудника?')">
            <?php echo csrf_field(); ?>
            <?php echo method_field('delete'); ?>
            <input type="submit" class="btn btn-outline-danger" value="Удалить сотрудника">
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH /var/www/resources/views/employees/parts/employees.blade.php ENDPATH**/ ?>