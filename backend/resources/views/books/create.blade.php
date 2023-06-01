@extends('layouts.layout')

@section('title', 'Добавить книгу')

@section('content')

  <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <h3>Добавить книгу</h3>

    @include('books.parts.form')

    <button type="submit" class="btn btn-outline-primary">Сохранить</button>
  </form>
@endsection