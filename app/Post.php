<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    
    //Many to one relationship
    public function employees() {
        return $this->belongsTo('App\Employee', 'employee_id');
    }
}
