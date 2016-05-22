<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('client_id')
                ->unsigned();
            $table->foreign('client_id')
                ->references('id')
                ->on('clients');
            $table->string('project_name');
            $table->string('project_lead_name')
                ->nullable();
            $table->string('project_lead_email_address')
                ->nullable();
            $table->string('project_lead_phone_number')
                ->nullable();
            $table->string('project_description', 4000)
                ->nullable();
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
        Schema::drop('projects');
    }
}
