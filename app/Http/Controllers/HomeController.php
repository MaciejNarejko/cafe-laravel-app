<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;

use App\Menu;

use App\Table;

use App\Type;

use App\OrderStatus;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $unpaidOrders = Order::where('id_status','1')->get();
        $allOrders = Order::where('created_at','>=', date('Y-m-d').' 00:00:00')->get();
        $menuPositions = Type::all();
        $paidOrders = Order::where('id_status','2')->where('created_at','>=', date('Y-m-d').' 00:00:00');
        $valueOrders = $paidOrders-> sum('order_value');
        $unavailableTables = Table::where('availability', '0');
        $allTables = Table::all();
        return view('home')
            ->with('orders', $unpaidOrders)
            ->with('allOrders', $allOrders)
            ->with('menuPositions', $menuPositions)
            ->with('allTables', $allTables)
            ->with('unavailableTables', $unavailableTables)
            ->with('valueOrders', $valueOrders);
    }
}
