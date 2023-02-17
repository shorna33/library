<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $timestamps = true;

    protected $fillable = [ 
        'title',
        'author_name',
        'category_id',
        'publisher',
        'edition',
    ];

    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }
    public function accessNo(){
        return $this->belongsTo('App\Accessno');
    }
}
