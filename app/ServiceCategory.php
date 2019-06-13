<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $table = 'services_categories';

    // One to many relationship
    public function services() {
        $this->hasMany('App\Servicey');
    }
}
