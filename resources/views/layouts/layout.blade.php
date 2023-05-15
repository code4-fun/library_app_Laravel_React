<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
        crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
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
          <a class="nav-link active" aria-current="page" href="{{ route('book.index') }}">
            Главная
          </a>
        </li>
        @auth
          @if(Auth::user()->role == '0' || Auth::user()->role == '1')
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Действия
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('book.create') }}">Добавить книгу</a></li>
                <li><a class="dropdown-item" href="{{ route('category.create') }}">Добавить категорию</a></li>
                <li><div class="dropdown-item" style="cursor:pointer" onclick="$('#xlsx').click()">Импортировать книги</div></li>
                @if(Auth::user()->role == '0')
                  <li><a class="dropdown-item" href="{{ route('employee.create') }}">Добавить сотрудника</a></li>
                @endif
              </ul>
            </li>
          @endif
          @if(Auth::user()->role == '0' || Auth::user()->role == '1')
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Показать
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('book.index') }}">Список книг</a></li>
                <li><a class="dropdown-item" href="{{ route('category.index') }}">Список категорий</a></li>
                @if(Auth::user()->role == '0')
                  <li><a class="dropdown-item" href="{{ route('employee.index') }}">Список сотрудников</a></li>
                @endif
              </ul>
            </li>
          @endif
        @endauth
        <li>
          @if(isset($categories))
            <div id="category_filter">
              <div class="filter_category">
                <span class="filter_label">Категория:</span>
                <div class="dropdown" id="category_dropdown_filter" style="height: 20px;">
                  <button class="dropdown-toggle calendar_category_dropdown_toggle"
                          id="calendar_category_filter" data-bs-toggle="dropdown">Все
                  </button>
                  <div class="dropdown-menu calendar_category_dropdown" id="calendar_category_filter_list" aria-labelledby="calendar_category_filter">
                    <div class="calendar_category_list">
                      <button class="dropdown-item p2 calendar_category_filter_item" data-slug="all">Все</button>
                      @foreach($categories as $category)
                        <button class="dropdown-item p2 calendar_category_filter_item"
                                data-slug="{{ $category->slug }}">{{ $category->title }}</button>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </li>
      </ul>
      @if(isset($categories))
        <form class="d-flex search_form">
          <input class="form-control me-2" name="search" id="search_book_input" type="search"
                 placeholder="Найти книгу" aria-label="Search">
        </form>
      @endif
      <ul class="navbar-nav ms-auto">
        <!-- Authentication Links -->
        @guest
          @if (Route::has('login'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
            </li>
          @endif

          @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Зарегистрироваться') }}</a>
            </li>
          @endif
        @else
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
               data-bs-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

<form style="display:none" action="{{ route('book.import') }}" method="post" enctype="multipart/form-data">
  @csrf
  <input type="file" id="xlsx" name="xlsx" class="dropdown-item" onchange="form.submit()"
         style="opacity:0; position:absolute; z-index:-1">
</form>

<div class="container">
  <div class="page">
    @if($errors->any())
      @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ $error }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endforeach
    @endif

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @yield('content')

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/js/script.js"></script>
</body>
</html>