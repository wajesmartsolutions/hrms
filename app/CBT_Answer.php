<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CBT_Answer extends Model
{
    protected $table = 'cbt_answers';

    protected $fillable = ['question_id','body','is_correct'];
}
