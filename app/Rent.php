<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    public function managers()
    {
        return $this->belongsTo('App\Manager');
    }

    public function tenant()
    {
        return $this->belongsTo('App\Tenant');
    }

    public function rentcollectiondates()
    {
        return $this->hasMany('App\RentCollectionDate');
    }
}
