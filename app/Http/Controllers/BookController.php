<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\XlsxRequest;
use App\Jobs\BooksImportJob;
use App\Jobs\CategoriesImportJob;
use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request, $category=null){
    $categories = Category::query()
      ->orderBy('categories.title')
      ->get();

    if($searchQuery = $request->query('search')){
      $allBooks = Book::query()
        ->where('title', 'like', '%'.$searchQuery.'%')
        ->orWhere('author', 'like', '%'.$searchQuery.'%')
        ->orWhere('description', 'like', '%'.$searchQuery.'%')
        ->count();

      $books = Book::query()
        ->where('title', 'like', '%'.$searchQuery.'%')
        ->orWhere('author', 'like', '%'.$searchQuery.'%')
        ->orWhere('description', 'like', '%'.$searchQuery.'%')
        ->orderBy('books.created_at', 'desc')
        ->paginate(6);

      if ($request->ajax()) {
        return view('books.parts.pages', [
          'books' => $books,
          'queryString' => $searchQuery,
          'allBooks' => $allBooks,
          'delete_books' => $request->query('delete_books')
        ])->render();
      }

      return view('books.index', [
        'books' => $books,
        'categories' => $categories,
        'queryString' => $searchQuery,
        'allBooks' => $allBooks,
        'delete_books' => $request->query('delete_books')
      ]);
    }

    if(isset($category)){
      if($category == 'all'){
        return redirect()->route('index');
      }
      $category_item = Category::query()->where('slug', $category)->first();
      if($category_item == null){
        return abort(404);
      } else {
        $books = Book::query()
          ->where('category_id', $category_item->id)
          ->orderBy('books.created_at', 'desc')
          ->paginate(6);
      }

      if ($request->ajax()) {
        return view('books.parts.pages', [
          'books' => $books,
          'delete_books' => $request->query('delete_books')
        ])->render();
      }

      return view('books.index', [
        'books' => $books,
        'categories' => $categories,
        'delete_books' => $request->query('delete_books')
      ]);
    }

    $books = Book::query()
      ->orderBy('books.created_at', 'desc')
      ->paginate(6);

    if ($request->ajax()) {
      return view('books.parts.pages', [
        'books' => $books,
        'delete_books' => $request->query('delete_books')
      ])->render();
    }

    return view('books.index', [
      'books' => $books,
      'categories' => $categories,
      'delete_books' => $request->query('delete_books')
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(){
    $categories = Category::query()
      ->orderBy('categories.title')
      ->get();

    return view('books.create', [
      'categories' => $categories
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(BookRequest $request){
    $book = new Book();
    $book->title = $request->title;
    $book->description = $request->description;
    $book->author = $request->author;
    $book->category_id = $request->category;
    $book->slug = SlugService::createSlug(Book::class, 'slug', $request->title);
    $book->rating = $request->rating;
    if($request->file('img')){
      $path = Storage::putFile('public/covers', $request->file('img'));
      $url = Storage::url($path);
      $book->cover = $url;
    }

    $book->save();
    return redirect()
      ->route('book.index')
      ->with('success', 'Книга успешно создана');
  }

  /**
   * Display the specified resource.
   */
  public function show(Request $request, $slug){
    $book = DB::table('books')
      ->leftJoin('categories', 'category_id', '=', 'categories.id')
      ->select('books.*', 'categories.title as category_title')
      ->where('books.slug', '=', $slug)
      ->first();

    $comments_count = Comment::where('book_id', $book->id)->count();

    if(!$book){
      return redirect()
        ->route('book.index')
        ->withErrors('Такой страницы не существует');
    }

    if ($request->ajax()) {
      return view('books.parts.book', compact('book', 'comments_count'))->render();
    }

    return view('books.show', compact('book', 'comments_count'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $slug){
    $categories = Category::query()
      ->orderBy('categories.title')
      ->get();

    $book = Book::query()
      ->where('slug', $slug)
      ->first();

    if(!$book){
      return redirect()
        ->route('book.index')
        ->withErrors('Такой книги не существует');
    }

    return view('books.edit', compact('book', 'categories'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(BookRequest $request, string $slug){
    $book = Book::query()
      ->where('slug', $slug)
      ->first();

    if(!$book){
      return redirect()
        ->route('book.index')
        ->withErrors('Такой книги не существует');
    }

    $book->title = $request->title;
    $book->description = $request->description;
    $book->author = $request->author;
    $book->category_id = $request->category;
    $book->slug = SlugService::createSlug(Book::class, 'slug', $request->title);
    $book->rating = $request->rating;
    if($request->file('img')){
      $path = Storage::putFile('public/covers', $request->file('img'));
      $url = Storage::url($path);
      $book->cover = $url;
    }

    $book->update();
    return redirect()
      ->route('book.show', ['slug' => $book->slug])
      ->with('success', 'Книга успешно отредактирована');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $slug){
    $book = Book::query()
      ->where('slug', $slug)
      ->first();

    if(!$book){
      return redirect()
        ->route('book.index')
        ->withErrors('Такой книги не существует');
    }

    if($book->cover){
      unlink(public_path($book->cover));
    }
    $book->delete();

    return redirect()
      ->route('book.index')
      ->with('success', 'Книга успешно удалена');
  }

  public function import(XlsxRequest $request){
    $url = null;

    if($request->file('xlsx')){
      $path = Storage::putFile('public/import', $request->file('xlsx'));
      $url = Storage::url($path);
    }

    Bus::batch([
      new CategoriesImportJob($url),
    ])->then(function(Batch $batch) use($url){
      Bus::batch([
        new BooksImportJob($url)
      ])->finally(function(Batch $batch) use($url){
        unlink(public_path($url));
      })->dispatch();
    })->dispatch();

    return redirect()
      ->route('book.index')
      ->with('success', 'Загрузка книг');
  }

  public function comments(Request$request, $slug){
    $comments = DB::table('comments')
        ->join('books', 'book_id', '=', 'books.id')
        ->join('users', 'author_id', '=', 'users.id')
        ->select('comments.id', 'comments.content', 'comments.created_at', 'users.name as comment_author')
        ->where('books.slug', '=', $slug)
        ->orderBy('comments.created_at', 'desc')
        ->get();
    if ($request->ajax()) {
      return view('comments.comments', compact('comments', 'slug'))->render();
    }
  }

  public function storeComment(CommentRequest $request, $slug){
    $book = Book::where('slug', $slug)->first();
    $author = User::where('id', $request->author)->first()->name;
    $comment = new Comment();
    $comment->content = $request->comment_textarea;
    $comment->author_id = $request->author;
    $comment->book_id = $book->id;
    $comment->save();
    if ($request->ajax()) {
      return view('comments.comment', compact('comment', 'author'))->render();
    }
  }
}