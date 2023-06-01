

<?php $__env->startSection('title', 'Главная страница'); ?>

<?php $__env->startSection('content'); ?>

  <?php if(isset($_GET['search'])): ?>
    <div class="search-stat">
      <?php if(count($books) > 0): ?>
        <h4>Результат поиска по запросу "<?= htmlspecialchars($_GET['search']) ?>"</h4>
        <p class="lead">Найдено книг: <?php echo e(count($posts)); ?></p>
      <?php else: ?>
        <h4>По запросу "<?= htmlspecialchars($_GET['search']) ?>" ничего не найдено.</h4>
        <a href="<?php echo e(route('post.index')); ?>" class="btn btn-outline-primary">Показать все книги</a>
      <?php endif; ?>
    </div>
  <?php endif; ?>


  <div class="row">
    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?php echo e($book->title); ?></h5>
            <div class="card__img">
              <img src="<?php echo e($book->img ?? asset('img/no_image.png')); ?>" class="card-img-top" alt="no image">
            </div>
            <div class="card-text">Автор: <?php echo e($book->author); ?></div>
          </div>
          <div class="card__bottom">
            <a href="<?php echo e(route('book.show', ['id' => $book->id])); ?>" class="btn btn-outline-primary">Посмотреть книгу</a>
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <?php if(!isset($_GET['search'])): ?>
    <?php echo e($books->links()); ?>

  <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Comp\2-е высшее\jh\52_медкорт\projects\library-laravel\resources\views/books/index.blade.php ENDPATH**/ ?>