<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_todos', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->json('todo')->nullable();
            $table->dateTime('range', 0)->storedAs('todo->"$.time"');
            $table->timestamps();

            $table->primary('id');
            $table->index('range');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_todos');
    }
}
