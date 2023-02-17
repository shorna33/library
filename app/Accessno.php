<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessno extends Model
{
    public $timestamps = true;

    protected $fillable = [ 
        'access_no'
    ];

    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }
    public function book(){
        return $this->belongsTo('App\Book', 'book_id');
    }
}
