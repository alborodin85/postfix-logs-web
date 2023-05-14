<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateAdmin extends Command
{
    protected $signature = 'app:create-admin ' .
                            '{email : email}' .
                            '{password : Пароль}';

    protected $description = 'Создает админа с правами просмотра логов';

    public function handle(): int
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $userArray = [
            'name' => $email,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make($password),
            'remember_token' => Str::random(10),
            'isAdmin' => true,
        ];

        User::create($userArray);

        return 0;
    }
}
