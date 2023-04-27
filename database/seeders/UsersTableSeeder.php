<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $testUserData = config('testing.users.test_user');
        $testUser = User::firstWhere('email', $testUserData['email']);
        if (!$testUser) {
            $testUserData['password'] = Hash::make($testUserData['password']);
            User::create($testUserData);
        }

        User::factory(10)->create();
        User::factory(5)->unverified()->create();
    }
}
