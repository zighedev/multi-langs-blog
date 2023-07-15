<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
		static $id = 0;
		$id++;
		return [
			'id' => $id,
			'approval' => rand(0, 1),
            'title_en' => fake()->text(rand(20, 40)),
			'title_fr' => fake()->text(rand(20, 40)),
			'title_ar' => fake()->text(rand(20, 40)),		
			'description_en' => fake()->text(rand(60, 90)),
			'description_fr' => fake()->text(rand(60, 90)),
			'description_ar' => fake()->text(rand(60, 90)),
			'sub_category_id' => rand(1, 50),
			
        ];
		
    }
}
