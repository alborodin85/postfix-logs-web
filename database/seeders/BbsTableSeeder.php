<?php

namespace Database\Seeders;

use App\Models\Bb;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BbsTableSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Bb::factory(100)->create();
    }
}
