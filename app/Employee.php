<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function property()
    {
        return $this->belongsTo('App\Property');
    }
    
    public function employeeSalaries()
    {
        return $this->hasMany('App\EmployeeSalary');
    }
}
