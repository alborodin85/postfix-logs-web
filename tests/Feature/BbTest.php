<?php

namespace Tests\Feature;

use App\Models\Bb;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class BbTest extends TestCase
{
    public function testCreating(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get(route('bb.add'))->assertOk();
        $bb = ['title' => 'Test', 'content' => 'Nice', 'price' => 15];
        $response = $this->actingAs($user)->post(route('bb.store'), $bb);
        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('bbs', ['title' => 'Test']);

    }
}
