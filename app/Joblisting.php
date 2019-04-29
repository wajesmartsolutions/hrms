<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Joblisting extends Model
{
    //  
     protected $fillable = [
        'jobcategory', 'requiredskill', 'role','maj_qualification','extra_skill',
        'max_age','expectedsalary','job_location','working_hours',
         'jobdescription','last_applydate','entrydate','jobstatus'
    ];

    protected $table ='joblisting';

    public function questions()
    {
        return $this->belongsToMany('App\Interview_questions','interview_questions_joblisting', 'Joblisting_id', 'interview_questions_id');
    }

    public function applicants()
    {
        return $this->hasMany('App\Applicants');
    }
}
