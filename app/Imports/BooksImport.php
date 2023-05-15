<?php

namespace App\Imports;

use App\Models\Book;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class BooksImport implements ToModel, WithChunkReading{
  private $categories;

  public function __construct(){
    $this->categories = Category::select('id', 'title')->get();
  }

  public function model(array $row){
    $category = $this->categories->where('title', $row[3])->first();
    return new Book([
      'category_id' => $category->id,
      'title' => $row[0],
      'author' => $row[1],
      'slug' => SlugService::createSlug(Book::class, 'slug', $row[0])
    ]);
  }

  public function chunkSize():int{
    return 100;
  }
}