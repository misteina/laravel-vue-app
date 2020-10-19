<?php

namespace Database\Factories;

use App\Models\UserTodo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserTodo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Auth::id(),
            'todo' => json_encode(
                [
                    '2020-10-12 00:00:00' =>
                    [
                        'title' => 'My title',
                        'body' => 'Todo details',
                        'category' => 'other'
                    ],
                    '2020-10-15 22:00:00' =>
                    [
                        'title' => 'My title 2',
                        'body' => 'Todo details 2',
                        'category' => 'meeting'
                    ]
                ]
            )
        ];
    }
}
