<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModelCurrentLogRowFactory extends Factory
{
    public function definition(): array
    {
        $errorLevels = [
            'panic', 'fatal', 'error', 'warning', 'statistics', 'reject'
        ];
        $errorLevelIndex = random_int(0, 5);
        return [
            'dateTime' => fake()->dateTime('Y-m-d H:i:s'),
            'hostName' => Str::random(5),
            'module' => Str::random(5),
            'procId' => random_int(2000, 6000),
            'queueId' => Str::random(11),
            'errorLevel' => $errorLevels[$errorLevelIndex],
            'rowText' => fake()->paragraph
        ];
    }
}
