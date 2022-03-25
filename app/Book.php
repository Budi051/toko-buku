<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    public function category()
    {
        return $this->belongsTo('App\Category','idKategori');
    }
}
