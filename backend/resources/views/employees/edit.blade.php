@extends('layouts.layout')

@section('title', 'Редактировать сотрудника')

@section('content')

  <form action="{{ route('employee.update', ['id' => $employee->id]) }}" method="post">
    @csrf
    @method('patch')
    <h3>Редактировать сотрудника</h3>

    @include('employees.parts.form')

    <button type="submit" class="btn btn-outline-primary save_employee_button">Сохранить</button>
  </form>
@endsection