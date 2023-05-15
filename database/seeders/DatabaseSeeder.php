<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void{
    \App\Models\User::factory()->create([         // В UserFactory создаются 10 читателей. У читателей role=2. Читатели могут просматривать книги.
      'name' => 'John Smith',                     // Читатель создается путем самостоятельной регистрации
      'email' => 'admin@domain.com',              // Здесь создается админ admin@domain.com. role=1. Админ может создавать книги и сотрудников
      'password' => Hash::make('1'),              // У сотрудников role=1. Сотрудники могут создавать книги, но не могут создавать сотрудников
      'role' => 0
    ]);

    \App\Models\User::factory()->create([
      'name' => 'Arthur Parker',
      'email' => 'user@mail.com',
      'password' => Hash::make('1'),
      'role' => 1
    ]);

    \App\Models\User::factory(10)->create();

    $dramaId = DB::table('categories')->insertGetId([
      'title' => 'Drama',
      'slug' => 'drama'
    ]);

    \App\Models\Book::factory()->create([
      'title' => 'Hamlet',
      'slug' => 'hamlet',
      'author' => 'William Shakespeare',
      'description' => fake()->realText(rand(400, 500)),
      'rating' => rand(1, 10),
      'cover' => null,
      'category_id' => $dramaId
    ]);

    \App\Models\Book::factory()->create([
      'title' => 'Waiting For Godot',
      'slug' => 'waiting-for-gdot',
      'author' => 'Samuel Beckett',
      'description' => fake()->realText(rand(400, 500)),
      'rating' => rand(1, 10),
      'cover' => null,
      'category_id' => $dramaId
    ]);

    \App\Models\Book::factory()->create([
      'title' => 'The Crucible',
      'slug' => 'the-crucible',
      'author' => 'Arthur Miller',
      'description' => fake()->realText(rand(400, 500)),
      'rating' => rand(1, 10),
      'cover' => null,
      'category_id' => $dramaId
    ]);

    $fictionId = DB::table('categories')->insertGetId([
      'title' => 'Classic',
      'slug' => 'classic'
    ]);

    \App\Models\Book::factory()->create([
      'title' => 'To Kill a Mockingbird',
      'slug' => 'to-kill-a-mockingbird',
      'author' => 'Harper Lee',
      'description' => fake()->realText(rand(400, 500)),
      'rating' => rand(1, 10),
      'cover' => null,
      'category_id' => $fictionId
    ]);

    \App\Models\Book::factory()->create([
      'title' => '1984',
      'slug' => '1984',
      'author' => 'George Orwell',
      'description' => fake()->realText(rand(400, 500)),
      'rating' => rand(1, 10),
      'cover' => null,
      'category_id' => $fictionId
    ]);

    \App\Models\Book::factory()->create([
      'title' => 'Romeo and Juliet',
      'slug' => 'romeo-and-juliet',
      'author' => 'William Shakespeare',
      'description' => fake()->realText(rand(400, 500)),
      'rating' => rand(1, 10),
      'cover' => null,
      'category_id' => $fictionId
    ]);

    $detectiveId = DB::table('categories')->insertGetId([
      'title' => 'Detective',
      'slug' => 'detective'
    ]);

    \App\Models\Book::factory()->create([
      'title' => 'Sherlock Holmes',
      'slug' => 'sherlock-holmes',
      'author' => 'Arthur Conan Doyle',
      'description' => fake()->realText(rand(400, 500)),
      'rating' => rand(1, 10),
      'cover' => null,
      'category_id' => $detectiveId
    ]);

    \App\Models\Book::factory()->create([
      'title' => 'And There Were None',
      'slug' => 'and-there-were-none',
      'author' => 'Agatha Christie',
      'description' => fake()->realText(rand(400, 500)),
      'rating' => rand(1, 10),
      'cover' => null,
      'category_id' => $detectiveId
    ]);

    \App\Models\Book::factory()->create([
      'title' => 'Murder on The Orient Express',
      'slug' => 'murder-on-the-orient-express',
      'author' => 'Agatha Christie',
      'description' => fake()->realText(rand(400, 500)),
      'rating' => rand(1, 10),
      'cover' => null,
      'category_id' => $detectiveId
    ]);

    $fantasyId = DB::table('categories')->insertGetId([
      'title' => 'Fantasy',
      'slug' => 'fantasy'
    ]);

    \App\Models\Book::factory()->create([
      'title' => 'Harry Potter And The Sorcerer’s Stone',
      'slug' => 'harry-potter-and-the-sorcerers-stone',
      'author' => 'J.K. Rowling',
      'description' => fake()->realText(rand(400, 500)),
      'rating' => rand(1, 10),
      'cover' => null,
      'category_id' => $fantasyId
    ]);

    \App\Models\Book::factory()->create([
      'title' => 'The Lord of The Rings',
      'slug' => 'the-lord-of-the-rings',
      'author' => 'J.R.R. Tolkien',
      'description' => fake()->realText(rand(400, 500)),
      'rating' => rand(1, 10),
      'cover' => null,
      'category_id' => $fantasyId
    ]);

    \App\Models\Book::factory()->create([
      'title' => 'A Game of Thrones',
      'slug' => 'a-game-of-thrones',
      'author' => 'George R.R. Martin',
      'description' => fake()->realText(rand(400, 500)),
      'rating' => rand(1, 10),
      'cover' => null,
      'category_id' => $fantasyId
    ]);

    \App\Models\Book::factory()->create([
      'title' => 'The Sword in the Stone',
      'slug' => 'the-sword-in-the-stone',
      'author' => 'T.H. White',
      'description' => fake()->realText(rand(400, 500)),
      'rating' => rand(1, 10),
      'cover' => null,
      'category_id' => $fantasyId
    ]);

    \App\Models\Book::factory()->create([
      'title' => 'The Lion, the Witch, and the Wardrobe',
      'slug' => 'the-lion-the-witch-and-the-wardrobe',
      'author' => 'C.S. Lewis',
      'description' => fake()->realText(rand(400, 500)),
      'rating' => rand(1, 10),
      'cover' => null,
      'category_id' => $fantasyId
    ]);
  }
}