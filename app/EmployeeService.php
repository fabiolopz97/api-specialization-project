<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeService extends Model
{
    protected $table = 'employees_services';
    
    //Many to one relationship
    public function employees(){
        return $this->belongsTo('App\Employee', 'employee_id');
    }
    
    public function services(){
        return $this->belongsTo('App\Service', 'service_id');
    }
}
