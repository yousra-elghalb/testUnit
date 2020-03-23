<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $guarded =[];

    //si on veut personaliser le path, on peut le faire ici au lieu de changer ds tte les methods
    public function path()
    {
        return '/books/' . $this->id ;
    }
}
