<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    use Notifiable;

    protected $guard = 'manager';

    protected $fillable = [
        'name', 'email', 'phone', 'package_id', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function package()
    {
        return $this->belongsTo('App\Package');
    }
    public function properties()
    {
        return $this->hasMany('App\Property');
    }
    public function rents()
    {
        return $this->hasMany('App\Rent');
    }

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

}
