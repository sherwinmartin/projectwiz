<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_logs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('project_id')
                ->unsigned();
            $table->foreign('project_id')
                ->references('id')
                ->on('projects');
            $table->integer('user_id')
                ->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->date('project_log_date');
            $table->text('project_log_description')
                ->nullable();
            $table->decimal('total_hours', 5, 2);
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
        Schema::drop('project_logs');
    }
}
