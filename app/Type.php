<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
  public $timestamps = false;
  protected $fillable = [
      'name', 'id_category', 'details'
  ];

  public function category(){

    return $this->belongsTo(Category::class,'id_category');
  }
  public function menus(){
     return $this->hasMany(Menu::class);
 }
}
