<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{   
    public function property()
    {
        return $this->belongsTo('App\Property');
    }
    public function level()
    {
        return $this->belongsTo('App\Level');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    } 
    public function tenant()
    {
        return $this->hasOne('App\Tenant');
    } 
}
