<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BackEndTest extends TestCase
{
    public function testDisallowUnregisteredUsers()
    {
        $response = $this->get('/todo');
        $response->assertJson(['error' => 'unauthorized']);
    }
}
