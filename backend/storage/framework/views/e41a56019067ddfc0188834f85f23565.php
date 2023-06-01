<div class="row">
  <h4 class="mb-3">Категории</h4>

  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-12">
      <div class="card_custom">
        <p class="card-title"><?php echo e($category->title); ?></p>
        <div class="card_custom_buttons">
          <a href="<?php echo e(route('categories.edit', ['slug' => $category->slug])); ?>" class="btn btn-outline-primary">Изменить категорию</a>
          <form action="<?php echo e(route('categories.destroy', ['slug' => $category->slug])); ?>" method="post"
                onsubmit="return confirm('Точно удалить эту категорию?')">
            <?php echo csrf_field(); ?>
            <?php echo method_field('delete'); ?>
            <input type="submit" class="btn btn-outline-danger" value="Удалить категорию">
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH E:\Comp\second_degree\jh\52_медкорт\projects\library-laravel\resources\views/categories/parts/categories.blade.php ENDPATH**/ ?>