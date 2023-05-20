<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('books', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->text('title');
      $table->text('slug');
      $table->text('author');
      $table->text('description')->nullable()->default(null);
      $table->smallInteger('rating')->nullable()->default(null);
      $table->text('cover')->nullable()->default(null);
      $table->timestamps();
      $table->smallInteger('category_id')->unsigned()->nullable()->default(null);
      $table->foreign('category_id')
        ->references('id')
        ->on('categories');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('books');
  }
};
