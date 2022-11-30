<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mess extends Model
{
    public function property()
    {
        return $this->belongsTo('App\Property');
    }
    public function level()
    {
        return $this->belongsTo('App\Level');
    }
    public function seats()
    {
        return $this->hasMany('App\Seat');
    }
}
