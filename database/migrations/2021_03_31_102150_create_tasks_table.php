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
            $table->text('description', 300);
            $table->boolean('is_complete')->default(false);
            //foreignId alias de bigInteger son demaciado grande solo usuar en caso que lo requiera mal parsis
            //en este caso.
            $table->foreignId('project_id')->references('id')->on('projects')
            ->onDelete('cascade');
            $table->foreignId('user_created_id')->references('id')->on('users')
            ->onDelete('set null'); 
            $table->foreignId('user_assigned_id')->references('id')->on('users')
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
