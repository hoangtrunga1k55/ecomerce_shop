<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table ='menu';
    public function subMenu(){
        return $this->hasMany('App\SubMenu','idMenu','id');
    }
}
