<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class BodyFactory extends Factory
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
			'id' 			=> $id,
			'body_en' => fake()->text(rand(300, 1000)),
			'body_fr' => rand(0, 1) == 1 ? fake()->text(rand(300, 1000)) : '',
			'body_ar' => fake()->text(rand(300, 1000)),
			'article_id' => $id,
			
        ];
	
    }
}
