@extends('layouts.layout')

@section('title', 'Редактировать категорию')

@section('content')

    <form action="{{ route('category.update', ['slug' => $category->slug]) }}" method="post">
        @csrf
        @method('patch')
        <h3>Редактировать категорию</h3>

        @include('categories.parts.form')

        <button type="submit" class="btn btn-outline-primary">Сохранить</button>
    </form>
@endsection