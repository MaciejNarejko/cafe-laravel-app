<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
  public $timestamps = false;
  protected $fillable = [
      'table_name', 'availability', 'capacity'
  ];
  public function order(){
     return $this->hasMany(Order::class);
  }
}
