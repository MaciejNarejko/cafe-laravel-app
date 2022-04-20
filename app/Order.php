<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  public function orderPositions(){
     return $this->hasMany(OrderPosition::class,'id_order');
 }
 public function table(){
   return $this->belongsTo(Table::class,'id_table');
 }
 public function user(){
   return $this->belongsTo(User::class,'id_user');
 }
    public function payment(){
        return $this->belongsTo(Payment::class,'id_method');
    }
    public function orderStatuses(){
        return $this->belongsTo(OrderStatus::class,'id_status');
    }

}
