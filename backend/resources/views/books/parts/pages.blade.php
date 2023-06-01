<div class="row">
  @if(isset($queryString))
    <div class="search-stat">
      @if($allBooks > 0)
        <h4>Результат поиска по запросу "<?= htmlspecialchars($_GET['search']) ?>"</h4>
        <p class="lead">Найдено книг: {{ $allBooks }}</p>
      @else
        <h4>По запросу "<?= htmlspecialchars($_GET['search']) ?>" ничего не найдено.</h4>
        <a href="{{ route('index') }}" class="btn btn-outline-primary">Показать все книги</a>
      @endif
    </div>
  @endif

  @if(sizeof($books) == 0)
    <div class="col-6">
      Ничего не найдено
    </div>
  @endif

  @foreach($books as $book)
    <div class="col-6">
      <div class="card">
        <div class="card-body">
          <div class="book_title">
            <h5 class="card-title">{{ $book->title }}</h5>
            @auth
              <input class="delete_checkbox" data-id="{{ $book->id }}" type="checkbox" style="{{ $delete_books == 'yes' ? 'display: block' : 'display: none' }}">
            @endauth
          </div>
          <div class="card__img">
            <img src="{{ $book->cover ?? asset('img/no_image.png') }}" class="card-img-top" alt="no image">
          </div>
          <div class="card-text">Автор: {{ $book->author }}</div>
        </div>
        <div class="card__bottom">
          <button data-slug="{{ $book->slug }}" class="btn btn-outline-primary show_book">Посмотреть книгу</button>
        </div>
      </div>
    </div>
  @endforeach

  {{ $books->links() }}
</div>
