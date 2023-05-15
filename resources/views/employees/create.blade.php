@extends('layouts.layout')

@section('title', 'Добавить сотрудника')

@section('content')

  <form action="{{ route('employee.store') }}" method="post">
    @csrf
    <h3>Добавить сотрудника</h3>

    @include('employees.parts.form')

    <button type="submit" class="btn btn-outline-primary">Сохранить</button>
  </form>
@endsection