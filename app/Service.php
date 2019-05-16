<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    
    // One to many relationship
    public function appointments() {
        $this->hasMany('App\Appointment');
    }
    
    public function employees_services() {
        $this->hasMany('App\EmployeeService');
    }
}
