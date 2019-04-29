<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CBT_Question extends Model
{

    protected $table = 'cbt_questions';
    protected $softDelete = true;
    protected $fillable = ['body'];


    public function answers() {
        return $this->hasMany('App\Answer');
    }

}
