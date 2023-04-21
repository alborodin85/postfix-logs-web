<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class UserAuthTest extends TestCase
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

    public function testRegistration(): void
    {
        $this->get(route('register'))->assertOk();
        $this->user['password'] = '123';
        $this->user['password_confirmation'] = $this->user['password'];
        $this->post('/register', $this->user)->assertSessionHasErrors();
        $this->user['password'] = $this->password;
        $this->user['password_confirmation'] = $this->user['password'];
        $this->post('/register', $this->user);
        $user = User::firstWhere('email', $this->user['email']);
        $this->assertEquals($this->user['name'], $user->name);
    }

    public function testLogin(): void
    {
        $this->user['password'] = Hash::make($this->password);
        User::create($this->user);
        $this->user['password'] = $this->password;

        $this->get(route('login'))->assertOk();

        $this->user['password'] = '123';
        $response = $this->post('/login', $this->user);
        $this->assertNotNull(Session::get('errors'));
        $response->assertHeader('location', route('login'));
        $response->assertRedirect(route('login'));

        $this->user['password'] = $this->password;
        $response = $this->post('/login', $this->user);
        $response->assertHeader('location', route('home'));
        $response->assertRedirect(route('home'));

        $user = User::firstWhere('email', $this->user['email']);
        $response = $this->actingAs($user)->get(route('home'));
        $response->assertOk();
    }

    public function testUserCreating()
    {
        $user = User::factory()->create();
        $this->assertDatabaseHas('users', ['email' => $user->email]);
    }
}
