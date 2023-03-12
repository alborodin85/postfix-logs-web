<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{

    private array $user;
    private string $password = '12345678';

    public function setUp(): void
    {
        parent::setUp();
        $this->user = [
            'name' => 'Vasa',
            'email' => 'vasa@email.com',
            'password' => $this->password,
            'password_confirmation' => $this->password,
            'email_verified_at' => now()->timestamp,
        ];
    }

    public function testBasicExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')->assertSee('Объявления');
        });
    }

    public function testLogin(): void
    {
        $this->user['password'] = Hash::make($this->password);
        $user = User::create($this->user);
        $this->user['password'] = $this->password;

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(route('login'))
                ->type('email', $this->user['email'])
                ->type('password', $this->user['password']);
            $browser->clickAndWaitForReload('@Login');
            $browser->assertPathIs('/home');
        });
    }
}
