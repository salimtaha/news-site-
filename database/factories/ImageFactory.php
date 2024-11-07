<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paths = ['test/news8.jpg', 'test/news7.jpg','test/news3.jpg' , 'test/news4.jpeg' , 'test/news5.webp'];
        return [
            'path'=>fake()->randomElement($paths),
        ];
    }

   
}
