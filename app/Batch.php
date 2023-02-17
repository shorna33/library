<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'title',
        'program'
    ];
    public $timestamps = true;

    public function student(){
        return $this->hasMany('App\Student');
    }
}
