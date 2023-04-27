<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BbFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->company(),
            'content' => fake()->sentence() . ' '. fake()->paragraph(),
            'price' => random_int(1, 500) * 100,
            'user_id' => random_int(1, 10),
        ];
    }
}
