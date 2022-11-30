<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{   
    public function managers()
    {
        return $this->belongsTo('App\Manager');
    }

    public function levels()
    {
        return $this->hasMany('App\Level');
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


    public function employees()
    {
        return $this->hasMany('App\Employee');
    }

    public function employeesalaries()
    {
        return $this->hasMany('App\EmployeeSalary');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    } 
    public function tenants()
    {
        return $this->hasMany('App\Tenant');
    } 
}
