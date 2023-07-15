<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
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
			'id' 					=> $id,
            'name_en' 				=> fake()->word().' ('.$id.')',
			'name_fr' 				=> fake()->word().' ('.$id.')',
			'name_ar' 				=> fake()->word().' ('.$id.')',
			'meta_title_en' 		=> fake()->text(rand(20, 40)),
			'meta_title_fr'			=> fake()->text(rand(20, 40)),
			'meta_title_ar' 		=> fake()->text(rand(20, 40)),
			'meta_description_en' 	=> fake()->text(rand(60, 90)),
			'meta_description_fr' 	=> fake()->text(rand(60, 90)),
			'meta_description_ar'	=> fake()->text(rand(60, 90)),
			'visibility' 			=> rand(0, 1),
			'category_id' 			=> rand(1, 10),
			
        ];
	
    }
}
