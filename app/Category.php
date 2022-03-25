<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps=false;
    protected $table = 'categories';
    public function books()
    {
        return $this->hasMany('App\Book','idKategori', 'id');
    }
}
