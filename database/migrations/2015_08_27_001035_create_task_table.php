<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('milestone_id')
                ->unsigned();
            $table->foreign('milestone_id')
                ->references('id')
                ->on('milestones');
            $table->string('task_name');
            $table->string('task_description', 4000)
                ->nullable();
            $table->date('start_date')
                ->nullable();
            $table->date('due_date')
                ->nullable();
            $table->integer('completion_status')
                ->default(0);
            $table->text('notes')
                ->nullable();
            $table->integer('predecessor_task_id')
                ->default(0);
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
        Schema::drop('tasks');
    }
}
