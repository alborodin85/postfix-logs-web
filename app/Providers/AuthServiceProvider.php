<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Bb;
use App\Policies\BbPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Bb::class => BbPolicy::class
    ];

    public function boot(): void
    {
        //
    }
}
