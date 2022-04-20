<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Order;

use App\OrderPosition;

use App\User;

class SalesReportController extends Controller
{
  public function summary(){
    return view('salesReport.summary');
  }

  public function repStat(Request $request){
    $request->validate([
            'from' => 'required',
            'to' => 'required',
            'reportType' => 'required'
    ]);
    $dateFrom = date("Y-m-d H:i:s", strtotime($request->from));
    $dateTo = date("Y-m-d H:i:s", strtotime($request->to));
    $repType = $request->reportType;

    switch($repType){
    case 1:
        $showOrders = DB::select("
        select categories.name as category, types.name as name, sizes.name as size, sum(order_positions.quantity) as quantity,
          menus.price * sum(order_positions.quantity) as value
        from order_positions
          join menus on order_positions.id_menu = menus.id
          join types on menus.id_type = types.id
          join sizes on menus.id_size = sizes.id
          join categories on types.id_category = categories.id
          join orders on orders.id = order_Positions.id_order
        where orders.id_status = '2' and orders.updated_at between ? and ?
          group by categories.name, types.name, sizes.name, menus.price
          order by sum(order_positions.quantity) desc",[$dateFrom, $dateTo]);
        $quantityOrders = DB::select("select count(order_positions.id) from order_positions
          join orders on orders.id = order_Positions.id_order
           where orders.id_status = '2' and orders.updated_at between ? and ?",[$dateFrom, $dateTo]);
      return view('salesReport.selected')->with('showOrders', $showOrders)
          ->with('repType', $repType)
          ->with('quantityOrders', $quantityOrders)
          ->with('dateFrom', date("m/d/Y H:i:s", strtotime($request->from)))
          ->with('dateTo', date("m/d/Y H:i:s", strtotime($request->to)));
      break;
    case 2:
      $showOrders = Order::whereBetween('updated_at', [$dateFrom, $dateTo])->where('id_status','2');
      $valueOrders = $showOrders-> sum('order_value');
      $quantityOrders = $showOrders->count();
         return view('salesReport.selected')->with('showOrders', $showOrders->paginate(10))
         ->with('valueOrders', $valueOrders)
         ->with('repType', $repType)
         ->with('quantityOrders', $quantityOrders)
         ->with('dateFrom', date("m/d/Y H:i:s", strtotime($request->from)))
         ->with('dateTo', date("m/d/Y H:i:s", strtotime($request->to)));
        break;
    case 3:
      $showOrders = DB::select("
        select users.name as employee, count(orders.id) as quantity, sum(orders.order_value) as value
        from orders
        join users on orders.id_user = users.id
        where orders.id_status = '2' and orders.updated_at between ? and ?
        group by users.name",[$dateFrom, $dateTo]);
        $quantityOrders = DB::select("select count(order_positions.id) from order_positions
        join orders on orders.id = order_Positions.id_order
         where orders.id_status = '2' and orders.updated_at between ? and ?",[$dateFrom, $dateTo]);
        return view('salesReport.selected')->with('showOrders', $showOrders)
          ->with('repType', $repType)
          ->with('quantityOrders', $quantityOrders)
          ->with('dateFrom', date("m/d/Y H:i:s", strtotime($request->from)))
          ->with('dateTo', date("m/d/Y H:i:s", strtotime($request->to)));
        break;
    }
  }
}
