<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    //
    protected $fillable = [
        'name','slug'
    ];

    protected $table ='roles';
}
