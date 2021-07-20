<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('firstname',45)->nullable();
            $table->string('lastname',45)->nullable();
            $table->string('regno',10)->nullable();
            $table->integer('age')->unsigned()->nullable();
            $table->string('gender',45)->nullable();
            $table->string('department',45)->nullable();
            $table->string('email',45)->nullable();
            $table->string('phono',15)->nullable();
            $table->string('address',255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
