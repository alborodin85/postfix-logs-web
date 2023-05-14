<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class AuthTest extends \Tests\TestCase
{
    public function testResetPassword()
    {
        $this->seed();
        Notification::fake();

        $email = config('testing.users.test_user.email');
        $user = User::firstWhere('email', $email);
        $this->get(route('password.request'))->assertOk();
        $this->post(route('password.email'), ['email' => $email])->assertRedirectToRoute('password.request');
        $link = '';
        $token = '';
        Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $notification, array $channels) use (&$link, &$token, $user) {
            $link = url(route('password.reset', [
                'token' => $notification->token,
                'email' => $user->getEmailForPasswordReset(),
            ], false));
            $token = $notification->token;

            return true;
        });

        $this->get($link)->assertOk();
        $response = $this->post(route('password.update'), ['token' => $token, 'email' => $user->email, 'password' => 'newPassword', 'password_confirmation' => 'newPassword']);
        $response->assertRedirectToRoute('home');
    }

    public function testNoAdmin()
    {
        $this->seed();
        $email = config('testing.users.test_user.email');
        $user = User::firstWhere('email', $email);
        $this->actingAs($user)->get(route('index'))->assertRedirectToRoute('login');
        $this->actingAs($user)->get(route('home'))->assertStatus(403);
        $this->actingAs($user)->get(route('login'))->assertRedirectToRoute('home');
        $this->actingAs($user)->get(route('getCurrentEmails'))->assertStatus(403);
        $this->actingAs($user)->get(route('getCurrentLogRows'))->assertStatus(403);
        $this->actingAs($user)->get(route('getArchiveEmails'))->assertStatus(403);
        $this->actingAs($user)->get(route('getArchiveLogRows'))->assertStatus(403);
    }

    public function testGuest()
    {
        $this->get(route('index'))->assertRedirectToRoute('login');
        $this->get(route('home'))->assertRedirectToRoute('login');
        $this->get(route('getCurrentEmails'))->assertRedirectToRoute('login');
        $this->get(route('getCurrentLogRows'))->assertRedirectToRoute('login');
        $this->get(route('getArchiveEmails'))->assertRedirectToRoute('login');
        $this->get(route('getArchiveLogRows'))->assertRedirectToRoute('login');
    }

    public function testLogout()
    {
        $email = 'test@ml.it5.su';
        $password = 'TestUserPass33';

        $this->artisan("app:create-admin $email $password")->assertOk();

        $response = $this->post(route('login'), ['email' => $email, 'password' => $password]);
        $response->assertRedirectToRoute('home');

        $response = $this->get(route('logout'));
        $response->assertRedirectToRoute('login');

        $response = $this->post(route('logout'));
        $response->assertRedirectToRoute('index');
    }

    public function testSuccessLogin()
    {
        $response = $this->get(route('login'));
        $response->assertOk();

        $email = 'test@ml.it5.su';
        $password = 'TestUserPass33';

        $this->artisan("app:create-admin $email $password")->assertOk();

        $response = $this->post(route('login'), ['email' => $email, 'password' => $password]);
        $response->assertRedirectToRoute('home');
    }
}
