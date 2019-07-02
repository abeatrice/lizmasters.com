<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admin_can_go_home()
    {
        $user = factory('App\User')->make();
        
        $this->actingAs($user)->get('/home')->assertStatus(403);
    }

    /** @test */
    public function admin_can_go_home()
    {
        $this->actingAs($this->admin())->get('/home')->assertOk();
    }
}
