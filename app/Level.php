<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function property()
    {
        return $this->belongsTo('App\Property');
    }

    public function tenants()
    {
        return $this->hasMany('App\Tenant');
    } 

    public function places()
    {
        return $this->hasMany('App\Place');
    } 

    public function messes()
    {
        return $this->hasMany('App\Mess');
    } 
    public function seats()
    {
        return $this->hasMany('App\Seat');
    } 
}
