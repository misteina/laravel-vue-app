<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserTodo;

use Tests\TestCase;

class BackEndTest extends TestCase
{
    use RefreshDatabase;

    public function testDisallowUnregisteredUsers(){
        $response = $this->get('/todo');
        $response->assertRedirect('/signin');
    }


    public function testRejectSignupWithInvalidNameInput(){
        $response = $this->json(
            'POST', 
            '/signup', 
            ['name' => '12Peter', 'email' => 'hello@you.com', 'password'=>'uy86ut']
        );
        $response->assertStatus(422);
    }

    
    public function testRegectSignupWithInvalidEmailInput(){
        $response = $this->json(
            'POST', 
            '/signup', 
            ['name' => 'Peter', 'email' => 'hello', 'password'=>'uy86ut']
        );
        $response->assertStatus(422);
    }

    public function testRegectSignupWithInvalidPasswordInput(){
        $response = $this->json(
            'POST', 
            '/signup', 
            ['name' => 'Peter', 'email' => 'hello', 'password'=>'']
        );
        $response->assertStatus(422);
    }


    public function testCheckSuccessfulSignup(){
        $response = $this->json(
            'POST', 
            '/signup',
            ['name' => 'Peter', 'email' => 'hello@you.com', 'password'=>'uy86ut']
        );
        $response->assertViewHas('registered');
    }


    public function testRejectSigninWithInvalidEmail(){
        $response = $this->json(
            'POST', 
            '/signin',
            ['email' => 'hello', 'password'=>'uy86ut']
        );
        $response->assertStatus(422);
    }


    public function testRejectSigninWithIncorrectEmail(){
        $user = User::factory()->create([
            'email' => 'hello@you.com',
            'password' => Hash::make('uy86ut')
        ]);
        $response = $this->json(
            'POST', 
            '/signin',
            ['email' => 'good@you.com', 'password'=>'uy86ut']
        );
        $response->assertViewHas('error');
    }


    public function testRejectSigninWithInvalidPassword(){
        $response = $this->json(
            'POST', 
            '/signin',
            ['email' => 'hello@you.com', 'password'=>'']
        );
        $response->assertStatus(422);
    }


    public function testRejectSigninWithIncorrectPassword(){
        $user = User::factory()->create([
            'email' => 'hello@you.com',
            'password' => Hash::make('uy86ut')
        ]);
        $response = $this->json(
            'POST', 
            '/signin',
            ['email' => 'hello@you.com', 'password'=>'0e8ryd']
        );
        $response->assertViewHas('error');
    }


    public function testCheckSuccessfulSignin(){
        $user = User::factory()->create([
            'name' => 'Peter',
            'email' => 'hello@you.com',
            'password' => Hash::make('uy86ut')
        ]);
        $response = $this->json(
            'POST', 
            '/signin',
            ['email' => 'hello@you.com', 'password'=>'uy86ut']
        );
        $response->assertRedirect('/todo');
    }


    public function testAddNewTodoItem(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->json(
            'POST', 
            '/todo/add',
            ['title' => 'My Todo title', 'body' => 'My Todo body', 'category' => 'other']
        );
        $response->assertSeeText('My Todo title');
    }


    public function testRejectAddTodoItemWithNoTitle(){
        $user = User::factory()->make();
        $response = $this->actingAs($user)->json(
            'POST', 
            '/todo/add',
            ['title' => '', 'body' => '', 'category' => 'other']
        );
        $response->assertJson(['error' => 'No title']);
    }


    public function testRejectAddTodoItemWithNoCategory(){
        $user = User::factory()->make();
        $response = $this->actingAs($user)->json(
            'POST', 
            '/todo/add',
            ['title' => 'My Todo title', 'body' => '', 'category' => '']
        );
        $response->assertJson(['error' => 'No category']);
    }


    public function testListAllTodoItems(){
        $user = User::factory()->has(UserTodo::factory())->create();
        $response = $this->actingAs($user)->getJson('/todo');
        $response->assertSeeTextInOrder(['2020-10-12 00:00:00','other']);
    }


    public function testListTodoItemsByCategory(){
        $user = User::factory()->has(UserTodo::factory())->create();
        $response = $this->actingAs($user)->json(
            'GET',
            '/todo',
            ['category' => 'other']
        );
        $response->assertSeeTextInOrder(['2020-10-12 00:00:00','other']);
    }


    public function testDeleteTodoItem(){
        $user = User::factory()->has(UserTodo::factory())->create();
        $response = $this->actingAs($user)->json(
            'POST',
            '/todo/delete',
            ['id' => '2020-10-15 22:00:00']
        );
        $response->assertDontSeeText('2020-10-15 22:00:00');
    }


    public function testUserLogOut(){
        $user = User::factory()->make();
        $response = $this->actingAs($user)->json('POST', '/logout');
        $response->assertRedirect('/signin');
    }


    /*private function dumpResponse($response){
        if (isset($response->getData()->message)){
            var_dump($response->getData()->message);
        } else {
            $response->dump();
        }
    }*/
}
