<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function package()
    {
        return $this->belongsTo('App\Package');
    }

    public function manager()
    {
        return $this->belongsTo('App\Manager');
    }
}
