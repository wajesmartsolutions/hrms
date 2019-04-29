<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicants extends Model
{
    //
       //
    protected $fillable = [
        'firstname', 'lastname', 'phonenumber','emailaddress','documents','joblisting_id'
    ];

    public function interview_answers()
    {
        return $this->hasMany('App\Interview_answers');

    }
    public function joblisting()
    {
        return $this->belongsTo('App\Joblisting');
    }
}
