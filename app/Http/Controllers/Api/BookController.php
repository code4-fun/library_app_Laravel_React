<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller{
  /**
   * Display a listing of the resource.
   */
  public function index(){
    return BookResource::collection(Book::with('category')->get());
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
  public function show(string $id){
    return new BookResource(Book::with('category')->findOrFail($id));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id){
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id){
    //
  }
}
