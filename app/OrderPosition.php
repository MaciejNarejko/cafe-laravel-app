<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPosition extends Model
{
  public $timestamps = false;
  public function order(){
    return $this->belongsTo(Order::class);
  }
  public function menu(){

    return $this->belongsTo(Menu::class,'id_menu');
  }
}
