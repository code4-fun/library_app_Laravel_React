<div class="mb-3">
  <input class="form-control"
         name="title"
         id="title"
         type="text"
         placeholder="Категория"
         autocomplete="off"
         value="{{ old('title') ?? $category->title ?? '' }}">
</div>