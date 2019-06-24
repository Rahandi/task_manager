<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_task', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id');
            $table->integer('id_user');
            $table->string('filename');
            $table->timestamps();
        });

        /*
        Delete files associated with Task ID
        */
       

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assign_task');
    }
}
