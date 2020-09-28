<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'feature_latest';
    public function Product(){
        return $this->hasMany('App\Product','id_feature_latest','id');
    }
}
