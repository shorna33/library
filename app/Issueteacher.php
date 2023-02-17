<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issueteacher extends Model
{
    public $timestamps = true;

    protected $fillable = [ 
        'teacher_id',
        'access_id'
    ];
    public function teacher(){
        return $this->belongsTo('App\Teacher','teacher_id');
    }
    public function access(){
        return $this->belongsTo('App\Accessno','access_id');
    }
    public function book(){
        return $this->belongsTo('App\Book','book_id');
    }
}
