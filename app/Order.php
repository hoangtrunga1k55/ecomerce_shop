<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='order';
    public function Shipping(){
        return $this->belongsTo('App\Shipping','idShipping','id');
    }
    public function Product(){
        return $this->belongsTo('App\Product','idProduct','id');
    }
}

