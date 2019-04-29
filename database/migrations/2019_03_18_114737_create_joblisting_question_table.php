<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoblistingQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joblisting_question', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->biginteger('joblisting_id')->unsigned();  
            $table->foreign('joblisting_id')->references('id')->on('joblisting');
            $table->biginteger('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('interview_questions');                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('joblisting_question');
    }
}
