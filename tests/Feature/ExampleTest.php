<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testHomePage(): void
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
    }

    public function testScheduler(): void
    {
        $result = Artisan::call('schedule:run');
        $this->assertEquals(0, $result);
    }

}
