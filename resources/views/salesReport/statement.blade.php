@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12">

      @if($quantityOrders > 0)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <p>Okres: <strong>{{$dateFrom}}</strong> - <strong>{{$dateTo}}</strong> </p>
          <p>Zrealizowane zamówienia: <strong>{{$quantityOrders}}</strong></p>
          <p>Wartość zrealizowanych zamówień: <strong>{{$valueOrders}} PLN</strong></p>
      </div>
      <table class="table table-bordered">
  <thead>
    <tr class="table-info">
      <th scope="col">#</th>
      <th scope="col">Zamówienie</th>
      <th scope="col">Wartość</th>
      <th scope="col">Płatność</th>
      <th scope="col">Data zamówienia</th>
      <th scope="col">Stolik</th>
      <th scope="col">Pracownik</th>
    </tr>
  </thead>
  <tbody>

    @foreach($showOrders as $order)
    <tr>
      <td scope="row">{{$order->id}}</td>
      <td>
        <ul class="report">
            @foreach($order->orderPositions as $position)
           <li>
             x {{$position->quantity}}
             {{$position->menu->size->name}}
             {{$position->menu->type->category->name}}
             {{$position->menu->type->name}}
           </li>
            @endforeach
        </ul>
      </td>
      <td>{{$order->order_value}}</td>
      <td>{{$order->payment->method}}</td>
      <td>{{$order->created_at}}</td>
      <td>{{$order->table->name}}</td>
      <td>{{$order->id_user}}</td>
    </tr>
    @endforeach
    <tr>
      <td colspan="7">Wartość zrealizowanych zamówień: {{$valueOrders}} PLN</td>
    </tr>
  </tbody>
</table>
    {{$showOrders-> appends($_GET)->links()}}
      @else
        <div class="alert alert-danger" role="alert">
          Brak danych za okres od {{$dateFrom}} do {{$dateTo}}
        </div>
      @endif
  </div>
  </div>
</div>
@endsection
