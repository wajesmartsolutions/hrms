<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
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
            $table->string('password')->nullable();       
            $table->string('joblisting_id');
            $table->integer('stage');
            $table->integer('interview_type_id');
            $table->unsignedInteger('interview_type_id')->nullable();
           
            $table->foreign('interview_type_id')
            ->references('id')
            ->on('interview_type')
            ->onUpdate('cascade')
            ->onDelete('no action');
            });

            $table->integer('document_id'); 
            $table->unsignedInteger('document_id')->nullable();
            $table->foreign('document_id')
            ->references('id')
            ->on('documents')
            ->onUpdate('cascade')
            ->onDelete('no action');
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
