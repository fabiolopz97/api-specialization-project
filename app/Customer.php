<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
        
    protected $hidden = [
        'password',
    ];
    
    // One to many relationship
    public function appointments() {
        return $this->hasMany('App\Appointment');
    }
}
