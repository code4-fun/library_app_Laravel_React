<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
        crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
  <link rel="shortcut icon" href="<?php echo e(asset('img/favicon.png')); ?>">
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
          <a class="nav-link active main_link" aria-current="page" href="<?php echo e(route('book.index')); ?>">
            Главная
          </a>
        </li>
        <?php if(auth()->guard()->check()): ?>
          <?php if(Auth::user()->role == '0' || Auth::user()->role == '1'): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Действия
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?php echo e(route('book.create')); ?>">Добавить книгу</a></li>
                <li><div class="dropdown-item" id="delete_books">Удалить книги</div></li>
                <li><a class="dropdown-item" href="<?php echo e(route('categories.create')); ?>">Добавить категорию</a></li>
                <li><div class="dropdown-item" style="cursor:pointer" onclick="$('#xlsx').click()">Импортировать книги</div></li>
                <?php if(Auth::user()->role == '0'): ?>
                  <li><a class="dropdown-item" href="<?php echo e(route('employee.create')); ?>">Добавить сотрудника</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
          <?php if(Auth::user()->role == '0' || Auth::user()->role == '1'): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Показать
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?php echo e(route('book.index')); ?>">Список книг</a></li>
                <li><a class="dropdown-item" href="<?php echo e(route('categories.index')); ?>">Список категорий</a></li>
                <?php if(Auth::user()->role == '0'): ?>
                  <li><a class="dropdown-item" href="<?php echo e(route('employee.index')); ?>">Список сотрудников</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
        <?php endif; ?>
        <li>
          <?php if(isset($categories)): ?>
            <div id="category_filter">
              <div class="filter_category">
                <span class="filter_label">Категория:</span>
                <div class="dropdown" id="category_dropdown_filter" style="height: 20px;">
                  <button class="dropdown-toggle category_dropdown_toggle" data-bs-toggle="dropdown">
                    Все
                  </button>
                  <div class="dropdown-menu category_dropdown">
                    <div class="category_list">
                      <button class="dropdown-item p2 category_filter_item" data-slug="all">Все</button>
                      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button class="dropdown-item p2 category_filter_item"
                                data-slug="<?php echo e($category->slug); ?>"><?php echo e($category->title); ?></button>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </li>
      </ul>
      <?php if(isset($categories)): ?>
        <form class="d-flex search_form">
          <input class="form-control me-2" name="search" id="search_book_input" type="search"
                 placeholder="Найти книгу" aria-label="Search">
        </form>
      <?php endif; ?>
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

<form style="display:none" action="<?php echo e(route('book.import')); ?>" method="post" enctype="multipart/form-data">
  <?php echo csrf_field(); ?>
  <input type="file" id="xlsx" name="xlsx" class="dropdown-item" onchange="form.submit()"
         style="opacity:0; position:absolute; z-index:-1">
</form>

<div class="container">
  <?php if(auth()->guard()->check()): ?>
    <div class="delete_books_btn">Удалить</div>
  <?php endif; ?>
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
<script src="/js/script.js"></script>
</body>
</html><?php /**PATH E:\Comp\second_degree\jh\52_медкорт\projects\library-laravel\resources\views/layouts/layout.blade.php ENDPATH**/ ?>