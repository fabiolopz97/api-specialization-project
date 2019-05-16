<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected  $table = 'appointments';
    
    //Many to one relationship
    public function services() {
        return $this->belongsTo('App\Service', 'service_id');
    }
    
    public function customers() {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
}
