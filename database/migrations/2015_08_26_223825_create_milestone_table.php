<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilestoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milestones', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('project_id')
                ->unsigned();
            $table->foreign('project_id')
                ->references('id')
                ->on('projects');
            $table->string('milestone_name');
            $table->date('start_date')
                ->nullable();
            $table->date('due_date')
                ->nullable();
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
        Schema::drop('milestones');
    }
}
