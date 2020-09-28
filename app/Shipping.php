<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table='shipping';
    public function User(){
        return $this->belongsTo('App\User','idUser','id');
    }
    public function Order(){
        return $this->hasMany('App\Order','idShipping','id');
    }

}
