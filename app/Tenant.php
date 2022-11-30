<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    public function property()
    {
        return $this->belongsTo('App\Property');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function place()
    {
        return $this->belongsTo('App\Place');
    }

    public function rent()
    {
        return $this->hasOne('App\Rent');
    }
}
