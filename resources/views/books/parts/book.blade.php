<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ $book->title }}</h5>
        <div class="card__img">
          <img src="{{ $book->cover ?? asset('img/no_image.png') }}" class="card-img-top" alt="image">
        </div>
        <div class="card-text"><b>Описание</b>: {{ $book->description }}</div>
        <div class="card-text"><b>Автор</b>: {{ $book->author }}</div>
        <div class="card-text"><b>Категория</b>: {{ $book->category_title }}</div>
        <div class="card-text"><b>Рейтинг</b>: {{ $book->rating }}</div>
        <div class="card-text"><b>Книга добавлена</b>: {{ \Carbon\Carbon::parse($book->created_at)->diffForHumans() }}
        </div>
      </div>
      <div class="card__bottom">
        <a href="{{ route('book.index') }}" class="btn btn-outline-primary">На главную</a>
        @auth
          @if(Auth::user()->role == '0' || Auth::user()->role == '1')
            <a href="{{ route('book.edit', ['slug' => $book->slug]) }}"
               class="btn btn-outline-primary">Редактировать</a>
            <form action="{{ route('book.destroy', ['slug' => $book->slug]) }}" method="post"
                  onsubmit="return confirm('Точно удалить эту книгу?')">
              @csrf
              @method('delete')
              <input type="submit" class="btn btn-outline-danger" value="Удалить">
            </form>
          @endif
          <span class="badge bg-white d-flex flex-row align-items-center">
            <span class="text-primary">Comments ({{ $comments_count }})</span>
            <div class="form-check form-switch">
              <input class="form-check-input" data-slug="{{ $book->slug }}"
                     type="checkbox" id="flexSwitchCheckChecked">
            </div>
          </span>
        @endauth

      </div>
    </div>
  </div>
</div>