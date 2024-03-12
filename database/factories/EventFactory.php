<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\User;
use \App\Models\Category;
use \App\Models\Event;
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
        // Get all category ids from the database
        $categoryIds = Category::pluck('id')->toArray();

        // Randomly select a category id from the array
        $randomCategoryId = $this->faker->randomElement($categoryIds);

        return [
            'user_id' => User::factory(),
            'category_id' => $randomCategoryId,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'location' => $this->faker->address,
            'totalTickets' => $this->faker->numberBetween(1, 100),
            'acceptance' => $this->faker->randomElement(['automatic', 'manual']),
            'status' => $this->faker->randomElement(['Pending', 'Approved', 'Rejected']),
        ];
    }
}

