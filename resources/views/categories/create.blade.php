@extends('layouts.layout')

@section('title', 'Добавить категорию')

@section('content')

  <form action="{{ route('category.store') }}" method="post">
    @csrf
    <h3>Добавить категорию</h3>

    @include('categories.parts.form')

    <button type="submit" class="btn btn-outline-primary">Сохранить</button>
  </form>
@endsection