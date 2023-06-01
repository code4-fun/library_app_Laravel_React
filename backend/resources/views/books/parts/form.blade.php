<div class="mb-3">
  <input class="form-control" name="title" id="title" type="text" placeholder="Заголовок" autocomplete="off" value="{{ old('title') ?? $book->title ?? '' }}">
</div>
<div class="mb-3">
  <input class="form-control" name="author" type="text" placeholder="Автор" autocomplete="off" value="{{ old('author') ?? $book->author ?? '' }}">
</div>
<div class="mb-3">
  <textarea class="form-control" name="description" rows="10" placeholder="Описание">{{ old('description') ?? $book->description ?? '' }}</textarea>
</div>
<div class="mb-3">
  <select class="form-select" name="category" aria-label="Категория">
    @if(isset($book))
      <option disabled>Категория</option>
      @foreach($categories as $category)
        @if($book->category_id == $category->id )
          <option value="{{ $category->id }}" selected>{{ $category->title }}</option>
        @else
          <option value="{{ $category->id }}">{{ $category->title }}</option>
        @endif
      @endforeach
    @else
      <option selected disabled>Категория</option>
      @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->title }}</option>
      @endforeach
    @endif
  </select>
</div>
<div class="mb-3">
  <select class="form-select" name="rating" aria-label="Рейтинг">
    @if(isset($book))
      <option disabled>Рейтинг</option>
      @for($i=1; $i <= 10; $i++)
        @if($book->rating == $i )
          <option value="{{ $i }}" selected>{{ $i }}</option>
        @else
          <option value="{{ $i }}">{{ $i }}</option>
        @endif
      @endfor
    @else
      <option selected disabled>Рейтинг</option>
      @for($i=1; $i <= 10; $i++)
        <option value="{{ $i }}">{{ $i }}</option>
      @endfor
    @endif
  </select>
</div>
<div class="mb-3">
  <input type="file" name="img" class="form-control">
</div>