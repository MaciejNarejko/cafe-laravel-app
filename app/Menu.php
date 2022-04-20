<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  public $timestamps = false;
  protected $fillable = [
      'price'
  ];

  public function type(){

    return $this->belongsTo(Type::class,'id_type');
  }
  public function size(){

    return $this->belongsTo(Size::class,'id_size');
  }
  public function orderPositions(){
     return $this->hasMany(OrderPosition::class);
 }
}
