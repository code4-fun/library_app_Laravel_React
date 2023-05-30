<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BookController::class, 'index'])->name('index');
Route::get('/book', [BookController::class, 'index'])->name('book.index');
Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
Route::post('/book', [BookController::class, 'store'])->name('book.store');
Route::get('/book/show/{slug}', [BookController::class, 'show'])->name('book.show');
Route::get('/book/edit/{slug}', [BookController::class, 'edit'])->name('book.edit');
Route::patch('/book/show/{slug}', [BookController::class, 'update'])->name('book.update');
Route::delete('/book/{slug}', [BookController::class, 'destroy'])->name('book.destroy');

Route::get('/book/{slug}/comments', [BookController::class, 'comments'])->name('book.comments.get');
Route::post('/book/{slug}/comments', [BookController::class, 'storeComment'])->name('book.comments.store');
Route::get('/book/category/{category}', [BookController::class, 'index'])->name('book.category');
Route::post('/book/import', [BookController::class, 'import'])->name('book.import');
Route::post('/books/delete', [BookController::class, 'deleteBooks'])->name('books.destroy');


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/show/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/edit/{slug}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::patch('/categories/show/{slug}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/employee/show/{id}', [EmployeeController::class, 'show'])->name('employee.show');
Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::patch('/employee/show/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');