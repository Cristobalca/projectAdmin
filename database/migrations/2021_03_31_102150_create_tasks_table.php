<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->text('description', 200);
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('user_created_id')->nullable();
            $table->unsignedBigInteger('user_assigned_id')->nullable();


            $table->foreign('project_id')->references('id')->on('projects')
            ->onDelete('cascade');
            
            $table->foreign('user_created_id')->references('id')->on('users')
            ->onDelete('set null'); 
            $table->foreign('user_assigned_id')->references('id')->on('users')
            ->onDelete('set null');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
