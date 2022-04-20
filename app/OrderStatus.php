<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    public $timestamps = false;
    public function Orders(){
        return $this->hasMany(Orders::class);
    }
}
