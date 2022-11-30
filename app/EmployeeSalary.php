<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    public function property()
    {
        return $this->belongsTo('App\Property');
    }

}
