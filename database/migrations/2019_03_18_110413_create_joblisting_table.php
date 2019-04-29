<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoblistingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joblisting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('jobcategory');
            $table->string('requiredskill');
            $table->string('role');
            $table->string('min_qualification');
            $table->string('extra_skill');
            $table->string('max_age');
            $table->string('expectedsalary');
            $table->string('job_location');
            $table->string('working_hours');
            $table->string('jobdescription');
            $table->string('last_applydate');
            $table->string('entrydate');         
        });
     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('joblisting');
    }
}
