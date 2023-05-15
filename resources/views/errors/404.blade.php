@extends('layouts.layout')
@section('title', '404')
@section('content')
    <h2>Ошибка 404</h2>
    <div class="card card__img">
        <img src="{{ asset('img/404.jpg') }}" alt="404">
    </div>
    <div id="button-404">
        <a href="/" class="btn btn-outline-primary">Вернуться на главную</a>
    </div>
@endsection
