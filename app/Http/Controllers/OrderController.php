<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;

use App\Table;

use App\User;

use App\OrderPosition;

use App\Menu;

use App\Size;

use App\Type;

use App\Category;

use App\Payment;

use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
  public function showTables(){
    $allTablesAvailable = Table::where('availability','1')->get();
    $html ='';
    foreach ($allTablesAvailable as $tables){
      $html .= '<button type="button" class="btn btn-success tab" id="'.$tables->name.'" data-id="'.$tables->id.'" name="'.$tables->name.'"> Stolik: '
              .$tables->name.'<br> Siedzenia: '.$tables->capacity.'</button>';
      }
    $allTablesUnavailable = Table::where('availability','!=','1')->get();
    foreach ($allTablesUnavailable as $tables){
      $html .= '<button type="button" class="btn btn-warning tab" data-id="'.$tables->id.'" name="'.$tables->name.'"> Stolik: '
              .$tables->name.'<br> Siedzenia: '.$tables->capacity.'</button>';
  };
  return $html;
  }

  public function service(){
    $categories = Category::all();
    return view ('orders.service')->with('categories', $categories);
  }

  public function typesWithCategory($id){
    $types = Type::where('id_category', $id)->get();
    $html = '';
    foreach ($types as $type){
      $html .= '
      <div class="col-3 text-center position">
          <a class="btn btn-outline-primary btn-link order" data-toggle="modal" data-target="#orderModal" data-name="'.$type->name.'"data-id="'.$type->id.'">
              <img class="img-fluid" src="'.url('/pictures/'.$type->picture).'">
              <br>
              '.$type->name.'
              <br>
          </a>
      </div>

      ';
    }
    return $html;
  }

    public function displayOrderPositions($id){
      $order = Order::where('id_table', $id)->where('id_status','1')->first();
      $html = '';
      if($order){
        $idOrder = $order->id;
        $listPositions = OrderPosition::where('id_order', $idOrder)->get();

         $html .= '
         <table class="table table-hover table-responsive-sm">
           <thead>
             <tr>
               <th scope="col">#</th>
               <th scope="col">Nazwa</th>
               <th scope="col">Wielko????</th>
               <th scope="col">Ilo????</th>
               <th scope="col">Cena</th>
               <th scope="col">Operacja</th>
             </tr>
           </thead>
           <tbody>';
           foreach($listPositions as $position){
             $html .= '
             <tr>
               <td>'.$position->id_menu.'</td>
               <td>'.$position->menu->type->category->name.' '. $position->menu->type->name.'</td>
               <td>'.$position->menu->size->name.'</td>
               <td>'.$position->quantity.'</td>
               <td>'.$position->menu->price.'</td>
               <td>
               <button type="button" class="btn btn-info position" data-id="'.$position->id.'">
               <i class="fa fa-trash" aria-hidden="true"></i> Usu??</button>
               </td>
             </tr>';
           }
         $html .='  </tbody>
         </table>
         <hr>
         <h5>Warto???? zam??wienia: '.$order->order_value.' PLN</h5>
         <hr>
         <div id="payment" class="form-group">
           <label for="tableNameLabel">Forma p??atno??ci</label>
            <select class="form-control" id="method" name="method">
                  <option value = "1">Got??wka</option>
                  <option value = "2">Karta</option>
            </select>
         </div>
         <button type="button" class="btn btn-primary pay" data-id="'.$idOrder.'">Przyjmij p??atno????</button>
         ';
       }
      else {
        $html .="Brak zam??wienia";
      }
      return $html;
    }
    public function getMenuSizes($id){
        $menus = Menu::where('id_type', $id)->get();
        $html='<div class="form-group">
            <label for="itemFormControlSelect1">Wariant</label>
            <select class="form-control" id="itemFormControlSelect1">';
        foreach ($menus as $item){
          $html .='
                <option value="'.$item->id.'">'.$item->size->name.' '.$item->price.' PLN</option>
          ';
          }
          $html .='</select></div>
                  <div class="form-group">
                    <label for="inputQuantity">Ilo????</label>
                    <input type="text" class="form-control" id="inputQuantity" name="quantity" placeholder="Ilo????" disabled><button class="btn btn-primary mt-2 plus" onclick="incrementValue()">+</button> <button class="btn btn-primary mt-2 minus" onclick="decrementValue()">-</button>
                  </div>
          ';
        return $html;
    }

    public function buyItem (Request $request){
      $idItem = $request->id_item;
      $type = $request->id_type;
      $table = $request->id_table;
      $quantityIteam = $request->quantity;
      $orderedItem = Menu::where('id', $idItem)->first();
      $order = Order::where('id_table', $table)->where('id_status','1')->first();
      if(empty($order->id)){
        $order = new Order();
        $user = Auth::id();
        $order -> id_table =  $table;
        $order -> id_user = $user;
        $order -> id_status = 1;
        $order -> id_method = 1;
        $order -> save();
        $idOrder = $order->id;
        $getTable = Table::where('id', $table)->first();
        $getTable -> availability = "0";
        $getTable -> save();
      }
      else{
        $idOrder = $order->id;
      }
      $orderPosition = new OrderPosition();
      $orderPosition -> id_order = $idOrder;
      $orderPosition -> id_menu = $orderedItem->id;
      $orderPosition -> quantity = $quantityIteam;
      $orderPosition -> save();
      $order->order_value = $order->order_value + ($quantityIteam * $orderedItem->price);
      $order->save();

     $listPositions = OrderPosition::where('id_order', $idOrder)->get();

      $html = '
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Wielko????</th>
            <th scope="col">Ilo????</th>
            <th scope="col">Cena</th>
            <th scope="col">Operacja</th>
          </tr>
        </thead>
        <tbody>';
        foreach($listPositions as $position){
          $html .= '
          <tr>
            <td>'.$position->id_menu.'</td>
            <td>'.$position->menu->type->name.'</td>
            <td>'.$position->menu->size->name.'</td>
            <td>'.$position->quantity.'</td>
            <td>'.$position->menu->price.'</td>
            <td>
            <button type="button" class="btn btn-info position" data-id="'.$position->id.'">
            <i class="fa fa-trash" aria-hidden="true"></i> Usu??</button>
            </td>
          </tr>';
        }
      $html .='  </tbody>
      </table>
      <hr>
      <h5>Warto???? zam??wienia: '.$order->order_value.' PLN</h5>
      <div id="payment" class="form-group">
        <label for="tableNameLabel">Forma p??atno??ci</label>
         <select class="form-control" id="method" name="method">
               <option value = "1">Got??wka</option>
               <option value = "2">Karta</option>
         </select>
      </div>
      <button type="button" class="btn btn-primary pay" data-id="'.$idOrder.'">Przyjmij p??atno????</button>
      ';

    return $html;
  }



  public function cancelPosition(Request $request){
    $position = $request-> IdPosition;
    $foundPosition = OrderPosition::where('id', $position)->first();
    $idOrder = $foundPosition -> id_order;
    $changePrice = ($foundPosition->quantity * $foundPosition->menu->price);
    $foundPosition -> delete();
    $order = Order::where('id', $idOrder)->first();
    $order -> order_value = $order -> order_value - $changePrice;
    $order -> save();
    $orderPosition = OrderPosition::where('id_order', $idOrder)->first();
    if(!$orderPosition){
      $tableOrder = $order-> id_table;
      $order -> delete();
      $availableTable = Table::where('id', $tableOrder)->first();
      $availableTable -> availability = "1";
      $availableTable -> save();
      $html = "Brak zam??wienia";
    }
    else {
    $listPositions = OrderPosition::where('id_order', $idOrder)->get();
    $html = '
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nazwa</th>
          <th scope="col">Wielko????</th>
          <th scope="col">Ilo????</th>
          <th scope="col">Cena</th>
          <th scope="col">Operacja</th>
        </tr>
      </thead>
      <tbody>';
      foreach($listPositions as $position){
        $html .= '
        <tr>
          <td>'.$position->id_menu.'</td>
          <td>'.$position->menu->type->name.'</td>
          <td>'.$position->menu->size->name.'</td>
          <td>'.$position->quantity.'</td>
          <td>'.$position->item_price.'</td>
          <td>
          <button type="button" class="btn btn-info position" data-id="'.$position->id.'">
          <i class="fa fa-trash" aria-hidden="true"></i> Usu??</button>
          </td>
        </tr>';
      }
    $html .='  </tbody>
    </table>
    <hr>
    <h5>Warto???? zam??wienia: '.$order->order_value.' PLN</h5>
    <div id="payment" class="form-group">
      <label for="tableNameLabel">Forma p??atno??ci</label>
       <select class="form-control" id="method" name="method">
             <option value = "got??wka">Got??wka</option>
             <option value = "karta">Karta</option>
       </select>
    </div>
    <button type="button" class="btn btn-primary pay" data-id="'.$idOrder.'">Przyjmij p??atno????</button>
    ';
    }
    return $html;
  }

  public function getBill(Request $request){
    $idOrder = $request -> idOrder;
    $paymentMethod = $request -> paymentMethod;
    $order = Order::where('id',$idOrder)->first();
    $order -> id_method = $paymentMethod;
    $order -> id_status = "2";
    $order -> save();
    $tableNumber = $order->id_table;
    $place = Table::where('id',$tableNumber)->first();
    $place -> availability = "1";
    $place -> save();
    return "/orders/displayBill/".$idOrder;
  }
  public function displayBill($idOrder){
    $order = Order::where('id',$idOrder)->first();
    $orderPositions = OrderPosition::where('id_order',$idOrder)->get();
    return view('orders/displayBill',['positions' => $orderPositions],['orders' => $order]);
  }
}
