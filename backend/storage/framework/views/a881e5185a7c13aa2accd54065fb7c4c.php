<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
        crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
  <link rel="shortcut icon" href="<?php echo e(asset('img/favicon.ico')); ?>">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light mb-4 header">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 custom_nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo e(route('book.index')); ?>">
            Главная
          </a>
        </li>
        <li class="nav-item custom_nav_item">
          <a class="nav-link custom_nav_link" href="<?php echo e(route('book.create')); ?>">
            Создать книгу
          </a>
        </li>
        <li>
          <div id="company_filter">
            <div class="filter_company">
              <span class="filter_label">Категория:</span>
              <div class="dropdown" id="company_dropdown_filter" style="height: 20px;">
                <button class="dropdown-toggle calendar_company_dropdown_toggle"
                        id="calendar_company_filter" data-bs-toggle="dropdown">Все
                </button>
                <div class="dropdown-menu calendar_company_dropdown" id="calendar_company_filter_list"
                     aria-labelledby="calendar_company_filter">
                  <div class="calendar_company_list">
                    <button class="dropdown-item p2 calendar_company_filter_item">Все</button>
                    <button class="dropdown-item p2 calendar_company_filter_item">item1</button>
                    <button class="dropdown-item p2 calendar_company_filter_item">item2</button>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
      <form class="d-flex" role="search" action="<?php echo e(route('book.index')); ?>">
        <input class="form-control me-2" name="search" type="search" placeholder="Найти книгу"
               aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">Поиск</button>
      </form>


      <ul class="navbar-nav ms-auto">
        <!-- Authentication Links -->
        <?php if(auth()->guard()->guest()): ?>
          <?php if(Route::has('login')): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Войти')); ?></a>
            </li>
          <?php endif; ?>

          <?php if(Route::has('register')): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Зарегистрироваться')); ?></a>
            </li>
          <?php endif; ?>
        <?php else: ?>
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
               data-bs-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false" v-pre>
              <?php echo e(Auth::user()->name); ?>

            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                <?php echo e(__('Logout')); ?>

              </a>

              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
              </form>
            </div>
          </li>
        <?php endif; ?>
      </ul>


    </div>
  </div>
</nav>

<div class="container">
  <div class="page">
    <?php if($errors->any()): ?>
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo e($error); ?>

          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <?php if(session('success')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    
    <?php echo $__env->yieldContent('content'); ?>
    
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
<?php /**PATH C:\OSPanel\domains\library-laravel\resources\views/layouts/layout.blade.php ENDPATH**/ ?>