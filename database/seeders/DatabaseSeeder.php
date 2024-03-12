<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Category;
use \App\Models\Event;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Event::factory(10)->create();
        

        // // Get some user and category IDs to associate with events
        // $userIds = User::pluck('id')->toArray();
        // $categoryIds = Category::pluck('id')->toArray();

        // // Generate some sample events
        // for ($i = 0; $i < 10; $i++) {
        //     Event::create([
        //         'user_id' => $userIds[array_rand($userIds)],
        //         'category_id' => $categoryIds[array_rand($categoryIds)],
        //         'title' => 'Event ' . ($i + 1),
        //         'description' => 'This is a sample event description.',
        //         'date' => now()->addDays($i),
        //         'location' => 'Sample Location ' . ($i + 1),
        //         'totalTickets' => rand(50, 100),
        //         'acceptance' => rand(0, 1) ? 'automatic' : 'manual',
        //         'status' => ['Pending', 'Approved', 'Rejected'][rand(0, 2)],
        //         'created_at' => now()->subDays(10)->addDays($i), // Adjust the dates as needed
        //         'updated_at' => now()->subDays(10)->addDays($i),
        //     ]);
        // }

    }
}
