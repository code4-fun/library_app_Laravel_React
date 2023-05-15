@extends('layouts.layout')

@section('title', 'Редактировать книгу')

@section('content')

  <form action="{{ route('book.update', ['slug' => $book->slug]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <h3>Редактировать книгу</h3>

    @include('books.parts.form')

    <button type="submit" class="btn btn-outline-primary">Сохранить</button>
  </form>
@endsection