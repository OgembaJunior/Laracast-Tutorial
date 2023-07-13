<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $users = \App\Models\User::factory(10)->create();

        \App\Models\Category::factory(4)->create();

        // \App\Models\Tag::factory(10)->create();


        // foreach($users as $user){

        //     $category = \App\Models\Category::inRandomOrder()->first(); 
        //     $tag = \App\Models\Tag::inRandomOrder()->first(); 

            
            //   $post =  \App\Models\Post::create([
            //         'user_id'=> $user->id,
            //         'category_id'=> $category->id,
            //         'slug' => Str::slug(fake()->unique()->sentence),
            //         'title' => fake()->sentence,
            //         'body' => fake()->paragraphs(3, true)
            //     ]);

        //         $tag->posts()->attach($post);

        // }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
