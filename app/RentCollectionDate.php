<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentCollectionDate extends Model
{
    public function rent()
    {
        return $this->belongsTo('App\Rent');
    }
}
