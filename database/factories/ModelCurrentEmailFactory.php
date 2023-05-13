<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModelCurrentEmailFactory extends Factory
{
    public function definition(): array
    {
        $statusesNames = [
            'bounced', 'send', 'deliverable'
        ];
        $statusesIndex = random_int(0, 2);
        return [
            'dateTime' => fake()->dateTime('Y-m-d H:i:s'),
            'queueId' => Str::random(11),
            'from' => fake()->safeEmail(),
            'to' => fake()->safeEmail(),
            'subject' => fake()->sentence(),
            'statusText' => fake()->sentence(),
            'statusCode' => random_int(200, 600),
            'statusName' => $statusesNames[$statusesIndex],
            'nonDeliveryNotificationId' => Str::random(11),
        ];
    }
}
