<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Joblisting extends Model
{
     use Searchable;
     
    protected $fillable = [
    'jobcategory', 'requiredskill', 'role','maj_qualification','extra_skill',
    'max_age','expectedsalary','job_location','working_hours','keywords',
    'last_applydate','entrydate','jobstatus','max_applications','max_age','expectedsalary'
    ];

    protected $table ='joblisting';

    protected $casts = [
        'keywords'=>'array'
    ];

    public function questions()
    {
        return $this->belongsToMany('App\Interview_questions','interview_questions_joblisting', 'Joblisting_id', 'interview_questions_id');
    }

    public function applicants()
    {
        return $this->hasMany('App\Applicants');
    }
}
