<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoUploadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_videos', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('applicant_id')->nullable();
        $table->foreign('applicant_id')
        ->references('id')
        ->on('applicants')
        ->onUpdate('cascade')
        ->onDelete('no action');

        $table->string('video_url');
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
        Schema::dropIfExists('interview_videos');
    }
}
