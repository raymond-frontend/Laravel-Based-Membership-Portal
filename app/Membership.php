<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = ['name'];

    function user(){
        return $this->belongsTo('App\User');
    }
}
