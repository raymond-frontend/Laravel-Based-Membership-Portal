<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paid extends Model
{
    protected $fillable = ['name'];

    function User(){
        return $this->belongsTo('App\User');
    }
}
