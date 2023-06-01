<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(){
    $categories = Category::query()
      ->orderBy('categories.title')
      ->get();
    return view('categories.index', [
      'categories' => $categories
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(){
    return view('categories.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(CategoryRequest $request){
    $category = new Category();
    $category->title = $request->title;
    $category->slug = SlugService::createSlug(Category::class, 'slug', $request->title);

    $category->save();
    return redirect()
      ->route('categories.index')
      ->with('success', 'Категория успешно создана');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id){
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $slug){
    $category = Category::query()
      ->where('slug', $slug)
      ->first();

    if(!$category){
      return redirect()
        ->route('categories.index')
        ->withErrors('Такой категории не существует');
    }

    return view('categories.edit', compact('category'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(CategoryRequest $request, string $slug){
    $category = Category::query()
      ->where('slug', $slug)
      ->first();

    if(!$category){
      return redirect()
        ->route('categories.index')
        ->withErrors('Такой категории не существует');
    }

    $category->title = $request->title;
    $category->slug = SlugService::createSlug(Category::class, 'slug', $request->title);

    $category->update();
    return redirect()
      ->route('categories.index')
      ->with('success', 'Категория успешно отредактирована');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $slug){
    $category = Category::query()
      ->where('slug', $slug)
      ->first();

    if(!$category){
      return redirect()
        ->route('categories.index')
        ->withErrors('Такой категории не существует');
    }

    $category->delete();
    return redirect()->route('categories.index');
  }
}