<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Post>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $path =  $this->faker->image(dir: public_path('storage/product_images'),width:250, height:250,fullPath: false);

        return [
            'title' => $this -> faker -> text(5),
            'description' => $this -> faker -> text(25),
            'price' => $this -> faker -> numerify('##'),
            'product_image' => 'product_images/'.$path
        ];
    }
}
