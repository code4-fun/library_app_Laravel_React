<div class="mb-3">
  <input class="form-control" name="title" id="title" type="text" placeholder="Заголовок" autocomplete="off" value="<?php echo e(old('title') ?? $book->title ?? ''); ?>">
</div>
<div class="mb-3">
  <input class="form-control" name="author" type="text" placeholder="Автор" autocomplete="off" value="<?php echo e(old('author') ?? $book->author ?? ''); ?>">
</div>
<div class="mb-3">
  <textarea class="form-control" name="description" rows="10" placeholder="Описание"><?php echo e(old('description') ?? $book->description ?? ''); ?></textarea>
</div>
<div class="mb-3">
  <select class="form-select" name="category" aria-label="Категория">
    <?php if(isset($book)): ?>
      <option disabled>Категория</option>
      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($book->category_id == $category->id ): ?>
          <option value="<?php echo e($category->id); ?>" selected><?php echo e($category->title); ?></option>
        <?php else: ?>
          <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
      <option selected disabled>Категория</option>
      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
  </select>
</div>
<div class="mb-3">
  <select class="form-select" name="rating" aria-label="Рейтинг">
    <?php if(isset($book)): ?>
      <option disabled>Рейтинг</option>
      <?php for($i=1; $i <= 10; $i++): ?>
        <?php if($book->rating == $i ): ?>
          <option value="<?php echo e($i); ?>" selected><?php echo e($i); ?></option>
        <?php else: ?>
          <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
        <?php endif; ?>
      <?php endfor; ?>
    <?php else: ?>
      <option selected disabled>Рейтинг</option>
      <?php for($i=1; $i <= 10; $i++): ?>
        <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
      <?php endfor; ?>
    <?php endif; ?>
  </select>
</div>
<div class="mb-3">
  <input type="file" name="img" class="form-control">
</div><?php /**PATH /var/www/resources/views/books/parts/form.blade.php ENDPATH**/ ?>