<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phonenumber');
            $table->string('emailaddress');
            $table->string('documents'); 
            $table->biginteger('joblisting_id')->unsigned();  
            $table->foreign('joblisting_id')->references('id')->on('joblisting');       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}
