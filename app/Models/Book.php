<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model{
  use HasFactory, Sluggable;

  protected $fillable = ['title', 'author', 'category_id'];

  public function category(){
    return $this->belongsTo('App\Models\Category');
  }

  public function sluggable():array{
    return [
      'slug' => [
        'source' => 'title'
      ]
    ];
  }
}