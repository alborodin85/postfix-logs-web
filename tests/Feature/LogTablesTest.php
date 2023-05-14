<?php

use App\Models\User;

class LogTablesTest extends \Tests\TestCase
{
    public function testCurrentLogEmails()
    {
        $user = $this->getUser();
        $this->actingAs($user)->get(route('getCurrentEmails'))->assertSee(__('messages.titles.getCurrentEmails'));
    }

    public function testCurrentLogRows()
    {
        $user = $this->getUser();
        $this->actingAs($user)->get(route('getCurrentLogRows'))->assertSee(__('messages.titles.getCurrentLogRows'));
    }

    public function testArchiveLogEmails()
    {
        $user = $this->getUser();
        $this->actingAs($user)->get(route('getArchiveEmails'))->assertSee(__('messages.titles.getArchiveEmails'));
    }

    public function testArchiveLogRows()
    {
        $user = $this->getUser();
        $this->actingAs($user)->get(route('getArchiveLogRows'))->assertSee(__('messages.titles.getArchiveLogRows'));
    }


    private function getUser(): User
    {
        $email = 'test@ml.it5.su';
        $password = 'TestUserPass33';
        $this->artisan("app:create-admin $email $password")->assertOk();
        $user = User::firstWhere('email', $email);

        return $user;
    }
}
