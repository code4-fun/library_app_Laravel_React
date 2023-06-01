<div class="mb-3">
  <input class="form-control"
         name="name"
         type="text"
         placeholder="Имя"
         autocomplete="off"
         value="<?php echo e(old('name') ?? $employee->name ?? ''); ?>">
</div>
<div class="mb-3">
  <input class="form-control"
         name="email"
         type="text"
         placeholder="email"
         autocomplete="off"
         value="<?php echo e(old('email') ?? $employee->email ?? ''); ?>">
</div>
<?php if(isset($employee)): ?>
  <div class="mb-3">
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" id="change_password">
      <label class="form-check-label" for="change_password">Изменить пароль</label>
    </div>
  </div>
<?php else: ?>
  <div class="mb-3" id="password_block">
    <input class="form-control"
           name="password"
           type="text"
           placeholder="Пароль"
           autocomplete="off">
  </div>
<?php endif; ?><?php /**PATH /var/www/resources/views/employees/parts/form.blade.php ENDPATH**/ ?>