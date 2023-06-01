
<?php $__env->startSection('title', '404'); ?>
<?php $__env->startSection('content'); ?>
    <h2>Ошибка 404</h2>
    <div class="card card__img">
        <img src="<?php echo e(asset('img/404.jpg')); ?>" alt="404">
    </div>
    <div id="button-404">
        <a href="/" class="btn btn-outline-primary">Вернуться на главную</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Comp\second_degree\jh\52_медкорт\projects\library-laravel\resources\views/errors/404.blade.php ENDPATH**/ ?>