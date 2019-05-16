<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleEmployee extends Model
{
    protected $table = 'roles_employees';
    
    //Many to one relationship
    public function roles() {
        return $this->belongsTo('App\Role', 'role_id');
    }
    
    public function employees() {
        return $this->belongsTo('App\Employee', 'employee_id');
    }
}
