<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
  public $timestamps = false;
  protected $fillable = [
      'name', 'volume'
  ];
  public function menus(){
     return $this->hasMany(Menu::class);
 }
}
