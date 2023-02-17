<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issuestud extends Model
{
    protected $fillable = [ 
        'student_id',
        'batch_id',
        'access_id'
    ];

    public function student(){
        return $this->belongsTo('App\Student','student_id');
    }
    public function batch(){
        return $this->belongsTo('App\Batch','batch_id');
    }
    public function access(){
        return $this->belongsTo('App\Accessno','access_id');
    }
    public function book(){
        return $this->belongsTo('App\Book','book_id');
    }
}
