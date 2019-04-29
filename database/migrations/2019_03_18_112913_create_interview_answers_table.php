<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('answer');
            $table->biginteger('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('interview_questions');
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
        Schema::dropIfExists('interview_answers');
    }
}
