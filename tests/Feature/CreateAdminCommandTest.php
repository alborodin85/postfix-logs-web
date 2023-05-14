<?php

class CreateAdminCommandTest extends \Tests\TestCase
{
    public function testCreateAdmin()
    {
        $this->artisan('app:create-admin admin@email.it5.su Passtro45')->assertOk();
        $this->assertDatabaseHas('users', ['email' => 'admin@email.it5.su']);

    }
}
