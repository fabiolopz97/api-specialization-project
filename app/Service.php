<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $guarded = ['id'];

    // One to many relationship
    public function appointments() {
        $this->hasMany('App\Appointment');
    }

    public function employees_services() {
        $this->hasMany('App\EmployeeService');
    }

    //Many to one relationship
    public function services_categories() {
        return $this->belongsTo('App\ServiceCategory', 'service_category_id');
    }
}
