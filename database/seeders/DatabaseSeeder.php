<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Article;
use App\Models\Body;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
		
		//\App\Models\Category::factory(6)->create();
		
		Category::factory(10)->create();
		SubCategory::factory(50)->create();
		Article::factory(400)->create();
		Body::factory(400)->create();
		Tag::factory(20)->create();
    }
}
