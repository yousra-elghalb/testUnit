<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded =[];

    //if u have several columns in ur DB that u want laravel to autho cast them into carbon instances:
    protected $dates = ['dob'];


    public function setDobAttribute($dob){

        $this->attributes['dob'] = Carbon::parse($dob);
    }


}
