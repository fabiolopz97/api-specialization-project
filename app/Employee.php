<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    
    // One to many relationship
    public function employees_services() {
        return $this->hasMany('App\EmployeeService');
    }
    
    public function posts() {
        return $this->hasMany('App\Post');
    }
    
    public function roles_employees() {
        return $this->hasMany('App\RoleEmployee');
    }
    
}
