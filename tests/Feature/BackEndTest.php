<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BackEndTest extends TestCase
{
    use RefreshDatabase;

    public function testDisallowUnregisteredUsers()
    {
        $response = $this->get('/todo');
        $response->assertJson(['error' => 'unauthorized']);
    }
    public function testRejectSignupWithInvalidNameInput()
    {
        $response = $this->json(
            'POST', 
            '/signup', 
            ['name' => '12Sally', 'email' => 'hello@you.com', 'password'=>'uy86ut']
        );
        $response->assertStatus(422);
    }
    public function testRegectSignupWithInvalidEmailInput()
    {
        $response = $this->json(
            'POST', 
            '/signup', 
            ['name' => 'Sally', 'email' => 'hello', 'password'=>'uy86ut']
        );
        $response->assertStatus(422);
    }
    public function testCheckSuccessfulSignup()
    {
        $response = $this->json(
            'POST', 
            '/signup',
            ['name' => 'Sally', 'email' => 'hello@you.com', 'password'=>'uy86ut']
        );
        $this->assertDatabaseHas(
            'users', 
            ['name' => 'Sally']
        );
    }
    public function testRejectSigninWithInvalidEmail()
    {
        $response = $this->json(
            'POST', 
            '/signin',
            ['email' => 'hello', 'password'=>'uy86ut']
        );
        $response->assertStatus(422);
    }
    public function testRejectSigninWithNoPassword()
    {
        $response = $this->json(
            'POST', 
            '/signin',
            ['email' => 'hello', 'password'=>'']
        );
        $response->assertStatus(422);
    }
}
