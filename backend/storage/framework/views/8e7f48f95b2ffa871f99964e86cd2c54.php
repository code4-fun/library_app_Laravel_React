<div class="row">
  <?php if(isset($queryString)): ?>
    <div class="search-stat">
      <?php if($allBooks > 0): ?>
        <h4>Результат поиска по запросу "<?= htmlspecialchars($_GET['search']) ?>"</h4>
        <p class="lead">Найдено книг: <?php echo e($allBooks); ?></p>
      <?php else: ?>
        <h4>По запросу "<?= htmlspecialchars($_GET['search']) ?>" ничего не найдено.</h4>
        <a href="<?php echo e(route('index')); ?>" class="btn btn-outline-primary">Показать все книги</a>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?php echo e($book->title); ?></h5>
          <div class="card__img">
            <img src="<?php echo e($book->cover ?? asset('img/no_image.png')); ?>" class="card-img-top" alt="no image">
          </div>
          <div class="card-text">Автор: <?php echo e($book->author); ?></div>
        </div>
        <div class="card__bottom">
          <a href="<?php echo e(route('book.show', ['id' => $book->id])); ?>" class="btn btn-outline-primary">Посмотреть
            книгу</a>
        </div>
      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  <?php echo e($books->links()); ?>

</div>


<?php /**PATH E:\Comp\second_degree\jh\52_медкорт\projects\library-laravel\resources\views/pages/pages.blade.php ENDPATH**/ ?>