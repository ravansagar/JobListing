<?php

namespace Database\Factories;

use App\Models\Tags;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobModel>
 */
class JobModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "imageUrl" => 'https://images.unsplash.com/photo-1508739826987-b79cd8b7da12?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8ZnJvbnRlbmQlMjBkZXZlbG9wZXJ8ZW58MHx8MHx8fDA%3D',
            "title" => $this->faker->jobTitle(),
            "salary" => $this->faker->numberBetween(1000,5000),
            "description" => $this->faker->sentence(50),
            "user_id" => User::factory(),
            "tags_id" => $this->faker->numberBetween(1,6),
        ];
    }

    
}
