<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testBasicExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')->assertSee('Объявления');
        });
    }

    public function testLogin(): void
    {
        $this->browse(function (Browser $browser) {
            $userArray = config('testing.users.test_user');
            $browser->visit(route('login'))
                ->type('email', $userArray['email'])
                ->type('password', $userArray['password']);
            $browser->clickAndWaitForReload('@Login');
            $browser->assertPathIs('/home');
        });
    }
}
