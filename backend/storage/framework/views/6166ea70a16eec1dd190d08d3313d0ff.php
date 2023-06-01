<div class="mb-3">
  <input class="form-control"
         name="title"
         id="title"
         type="text"
         placeholder="Категория"
         autocomplete="off"
         value="<?php echo e(old('title') ?? $category->title ?? ''); ?>">
</div><?php /**PATH /var/www/resources/views/categories/parts/form.blade.php ENDPATH**/ ?>