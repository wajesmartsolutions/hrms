<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interview_answers extends Model
{
    //
    protected $fillable = [
        'answer','question_id','applicant_id'
    ];

    protected $table ='interview_answers';


    public function applicants()
    {
        return $this->belongTo('App\Applicants');
    }

    public function interview_question() {
        return $this->hasMany('App\Interview_questions');
    }


}
