<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interview_questions extends Model
{

    protected $fillable = [
        'required', 'question'
    ];

    protected $table ='interview_questions';

    public function Joblisting()
    {
        return $this->belongsToMany('App\Joblisting','interview_questions_joblisting', 'interview_questions_id','Joblisting_id' );
    }

    public function interview_answers(){

        return $this->belongsTo('App\Interview_answers');
    }



}
