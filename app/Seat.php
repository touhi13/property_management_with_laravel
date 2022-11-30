<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public function property()
    {
        return $this->belongsTo('App\Property');
    }
    public function level()
    {
        return $this->belongsTo('App\Level');
    }
    public function mess()
    {
        return $this->belongsTo('App\Mess');
    }
}
