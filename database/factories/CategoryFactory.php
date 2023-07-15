<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'name_en' 		=> fake()->word().' ('.$id.')',
			'name_fr' 		=> fake()->word().' ('.$id.')',
			'name_ar' 		=> fake()->word().' ('.$id.')',
			'visibility' 	=> rand(0, 1),
			'ads'			=> rand(0, 1),
			
        ];
		
    }
}
