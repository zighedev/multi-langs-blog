<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class TagFactory extends Factory
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
			'name_en' => fake()->word().' ('.$id.')',
			'name_fr' => fake()->word().' ('.$id.')',
			'name_ar' => fake()->word().' ('.$id.')',
            'title_en' => fake()->text(rand(20, 40)),
			'title_fr' => fake()->text(rand(20, 40)),
			'title_ar' => fake()->text(rand(20, 40)),		
			'description_en' => fake()->text(rand(60, 90)),
			'description_fr' => fake()->text(rand(60, 90)),
			'description_ar' => fake()->text(rand(60, 90)),			
			
        ];
		
    }
}
