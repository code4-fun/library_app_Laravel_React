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

  <?php if(sizeof($books) == 0): ?>
    <div class="col-6">
      Ничего не найдено
    </div>
  <?php endif; ?>

  <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-6">
      <div class="card">
        <div class="card-body">
          <div class="book_title">
            <h5 class="card-title"><?php echo e($book->title); ?></h5>
            <input class="delete_checkbox" data-id="<?php echo e($book->id); ?>" type="checkbox" style="<?php echo e($delete_books == 'yes' ? 'display: block' : 'display: none'); ?>">
          </div>
          <div class="card__img">
            <img src="<?php echo e($book->cover ?? asset('img/no_image.png')); ?>" class="card-img-top" alt="no image">
          </div>
          <div class="card-text">Автор: <?php echo e($book->author); ?></div>
        </div>
        <div class="card__bottom">
          <button data-slug="<?php echo e($book->slug); ?>" class="btn btn-outline-primary show_book">Посмотреть книгу</button>
        </div>
      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  <?php echo e($books->links()); ?>

</div>
<?php /**PATH /var/www/resources/views/books/parts/pages.blade.php ENDPATH**/ ?>