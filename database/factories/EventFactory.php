<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
            'title' => $this->faker->text(40),
            'category_id' => Category::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph(),
            'date' => $this->faker->dateTimeThisYear(now()->addMonths(4)),
            'price' => $this->faker->randomNumber(3),
            'capacity' => $this->faker->randomNumber(3),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'zipcode' => $this->faker->postcode(),
            'image' => $this->faker->imageUrl(),

        ];
    }
}
