<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Response;

class BookController extends Controller{
  /**
   * Display a listing of the resource.
   */
  public function index(){
    return BookResource::collection(Book::all());
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(BookRequest $request){
    $new_book = Book::create($request->validated());
    return new BookResource($new_book);
  }

  /**
   * Display the specified resource.
   */
  public function show(Book $book){
    return new BookResource($book);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(BookRequest $request, Book $book){
    $book->update($request->validated());
    return new BookResource($book);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Book $book){
    $book->delete();
    return response(null, Response::HTTP_NO_CONTENT);
  }
}
