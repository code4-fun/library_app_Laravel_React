<?php

namespace App\Imports;

use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;
use Maatwebsite\Excel\Concerns\WithUpserts;

class CategoryImport implements ToModel, WithUpserts, WithUpsertColumns, WithChunkReading{
  public function uniqueBy():string|array{
    return 'title';
  }

  public function upsertColumns(){
    return [];
  }

  public function model(array $row){
    return new Category([
      'title' => $row[3],
      'slug' => SlugService::createSlug(Category::class, 'slug', $row[3])
    ]);
  }

  public function chunkSize():int{
    return 100;
  }
}