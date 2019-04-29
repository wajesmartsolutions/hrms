<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes as softDeletes;

class CBT_Question extends Model
{
    use softDeletes;

    protected $table = 'cbt_questions';

    protected $dates = ['deleted_at'];
    protected $fillable = ['question', 'option_A', 'option_B', 'option_C','option_D','required','correct_answer'];

    protected $hidden = [
        'correct_answer'
    ];

    public function answers() {
        return $this->hasMany('App\Answer');
    }

}
