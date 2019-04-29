<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyjobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applyjobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->biginteger('joblisting_id')->unsigned();  
            $table->foreign('joblisting_id')->references('id')->on('joblisting');
            $table->biginteger('applicant_id')->unsigned();
            $table->foreign('applicant_id')->references('id')->on('applicants');      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applyjobs');
    }
}
