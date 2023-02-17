<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'desig'
    ];
    public $timestamps = true;

    public function issueteacher(){
        return $this->hasMany('App\Issueteacher');
    }
}
