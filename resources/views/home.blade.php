@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12">
                <div class="col-12 stats mb-4">
                    <h4>Statystyki</h4>
                    <div class="col-12 staty row">
                        <div class="col-3 col-md-3 stat">
                            <div class="card border-success p-2">
                                <div class="text-success text-center mt-2">
                                    <h4 class="topicon"><i class="fa fa-shopping-bag" aria-hidden="true"></i></h4>
                                    <h4 class="topname">Zamówienia dziś</h4>
                                </div>
                                <div class="text-success text-center mt-1"><h2>{{$allOrders->count()}}</h2></div>
                            </div>
                        </div>
                        <div class="col-3 col-md-3 stat">
                            <div class="card border-warning p-2">
                                <div class="text-warning text-center mt-2">
                                    <h4 class="topicon"><i class="fa fa-calendar" aria-hidden="true"></i></h4>
                                    <h4 class="topname">Obłożenie</h4>
                                </div>
                                <div class="text-warning text-center mt-1"><h2>{{$unavailableTables->count()}}
                                        / {{$allTables->count()}}</h2></div>
                            </div>
                        </div>
                        <div class="col-3 col-md-3 stat">
                            <div class="card border-info p-2">
                                <div class="text-info text-center mt-2">
                                    <h4 class="topicon"><i class="fa fa-coffee" aria-hidden="true"></i></h4>
                                    <h4 class="topname">Produkty</h4>
                                </div>
                                <div class="text-info text-center mt-1"><h2>{{$menuPositions->count()}}</h2></div>
                            </div>
                        </div>
                        <div class="col-3 col-md-3 stat">
                            <div class="card border-danger p-2">
                                <div class="text-danger text-center mt-2">
                                    <h4 class="topicon"><i class="fa fa-money" aria-hidden="true"></i></h4>
                                    <h4 class="topname">Utarg dzienny</h4>
                                </div>
                                <div class="text-danger text-center mt-1"><h2>{{$valueOrders}} PLN</h2></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 ordersNow">
            <h4>Obsługiwane aktualnie zamówienia</h4>
            <table class="table table-bordered table-hover bill table-responsive-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Stolik</th>
                    <th>Zamówienie</th>
                    <th>Wartość zamówienia</th>
                    <th>Status</th>
                    <th>Data zamówienia</th>
                    <th>Pracownik</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td></td>
                        <td>{{$order->table->name}}</td>
                        <td>
                            <ul class="report">
                                @foreach($order->orderPositions as $position)
                                    <li>
                                        x {{$position->quantity}}
                                        {{$position->menu->type->category->name}}
                                        {{$position->menu->type->name}}
                                        {{$position->menu->size->name}}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{$order->order_value}}</td>
                        <td>{{$order->orderstatuses->name}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->user->name}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
