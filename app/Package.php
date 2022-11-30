<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function managers()
    {
        return $this->hasMany('App\Manager');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}
