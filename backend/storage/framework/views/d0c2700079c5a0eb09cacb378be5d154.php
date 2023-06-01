<div class="row book_card">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo e($book->title); ?></h5>
        <div class="card__img">
          <img src="<?php echo e($book->cover ?? asset('img/no_image.png')); ?>" class="card-img-top" alt="image">
        </div>
        <div class="card-text"><b>Описание</b>: <?php echo e($book->description); ?></div>
        <div class="card-text"><b>Автор</b>: <?php echo e($book->author); ?></div>
        <div class="card-text"><b>Категория</b>: <?php echo e($book->category_title); ?></div>
        <div class="card-text"><b>Рейтинг</b>: <?php echo e($book->rating); ?></div>
        <div class="card-text"><b>Книга добавлена</b>: <?php echo e(\Carbon\Carbon::parse($book->created_at)->diffForHumans()); ?>

        </div>
      </div>
      <div class="card__bottom">
        <a href="<?php echo e(route('book.index')); ?>" class="btn btn-outline-primary">На главную</a>
        <?php if(auth()->guard()->check()): ?>
          <?php if(Auth::user()->role == '0' || Auth::user()->role == '1'): ?>
            <a href="<?php echo e(route('book.edit', ['slug' => $book->slug])); ?>"
               class="btn btn-outline-primary">Редактировать</a>
            <form action="<?php echo e(route('book.destroy', ['slug' => $book->slug])); ?>" method="post"
                  onsubmit="return confirm('Точно удалить эту книгу?')">
              <?php echo csrf_field(); ?>
              <?php echo method_field('delete'); ?>
              <input type="submit" class="btn btn-outline-danger" value="Удалить">
            </form>
          <?php endif; ?>
          <span class="badge bg-white d-flex flex-row align-items-center">
            <span class="text-primary">Комментарии (<?php echo e($comments_count); ?>)</span>
            <div class="form-check form-switch">
              <input class="form-check-input form-check-input_comments" data-slug="<?php echo e($book->slug); ?>"
                     type="checkbox" id="flexSwitchCheckChecked">
            </div>
          </span>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div><?php /**PATH E:\Comp\second_degree\jh\52_медкорт\projects\library-laravel\resources\views/books/parts/book.blade.php ENDPATH**/ ?>