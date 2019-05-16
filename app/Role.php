<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    
    // One to many relationship
    public function roles_employees(){
        return $this->hasMany('App\RoleEmployee');
    }
}
