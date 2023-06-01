<div class="row">
  <h4 class="mb-3">Категории</h4>

  @foreach($categories as $category)
    <div class="col-12">
      <div class="card_custom">
        <p class="card-title">{{ $category->title }}</p>
        <div class="card_custom_buttons">
          <a href="{{ route('categories.edit', ['slug' => $category->slug]) }}" class="btn btn-outline-primary">Изменить категорию</a>
          <form action="{{ route('categories.destroy', ['slug' => $category->slug]) }}" method="post"
                onsubmit="return confirm('Точно удалить эту категорию?')">
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-outline-danger" value="Удалить категорию">
          </form>
        </div>
      </div>
    </div>
  @endforeach
</div>