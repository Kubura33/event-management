<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'category_id' => Category::all()->random()->id,
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph(),
            'date' => $this->faker->date(),
            'price' => $this->faker->randomNumber(3),
            'capacity' => $this->faker->randomNumber(3),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'zipcode' => $this->faker->postcode(),

        ];
    }
}
