<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaitaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilaitask', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id');
            $table->integer('user_id');
            $table->integer('nilai');
           
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
        Schema::dropIfExists('nilaitask');
    }
}
