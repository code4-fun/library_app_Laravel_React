@extends('layouts.layout')

@section('title', $book->title)

@section('content')
  @include('books.parts.book')
@endsection