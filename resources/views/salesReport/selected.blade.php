@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12 sale">
            <h3>Raporty</h3>
            <div class="card">
              <div class="card-body">
                <div class="report">
                <form action="/salesReport/repStat" method="POST">
                  @csrf
                  <div class="form-group repc">
                    <select name="reportType"class="custom-select">
                      <option value="1" @if($repType=='1') selected='selected' @endif>Najpopularniejsze produkty</option>
                      <option value="2" @if($repType=='2') selected='selected' @endif>Sprzedaż</option>
                      <option value="3" @if($repType=='3') selected='selected' @endif>Aktywność pracowników</option>
                    </select>
                  </div>
                  <div class="form-group repa">
                     <div class="input-group date" id="from" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" name="from" value="{{$dateFrom}}" data-target="from"/>
                          <div class="input-group-append" data-target="#from" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                    </div>
                </div>
              <div class="form-group repb">
                 <div class="input-group date" id="to" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" name="to" value="{{$dateTo}}" data-target="#to"/>
                      <div class="input-group-append" data-target="#to" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
              </div>
            <div class="form-group repd">
            <input class="btn btn-primary" type="submit" value="Generuj">
          </div>
            </form>
          </div>
        </div>
      </div>
  </div>
    <div class="col-sm-12">
    <div class="summary">
      @if($quantityOrders==0 or empty($showOrders))
        <div class="alert alert-danger" role="alert">
          Brak danych za okres od {{$dateFrom}} do {{$dateTo}}
        </div>
      @else
        @if($repType==1)
        <table class="table table-bordered table-responsive-sm">
          <thead>
            <tr class="table-primary">
              <th scope="col">Rodzaj</th>
              <th scope="col">Typ</th>
              <th scope="col">Wielkość</th>
              <th scope="col">Ilość sprzedana</th>
              <th scope="col">Wartość</th>
            </tr>
          </thead>
          <tbody>
          @foreach($showOrders as $product)
          <tr>
            <td>{{$product->category}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->size}}</td>
            <td>{{$product->quantity}}</td>
            <td>{{$product->value}}</td>
          </tr>
          @endforeach
        </tbody>
        </table>
        @endif
        @if($repType==2)
          <table class="table table-bordered table-responsive-sm">
            <thead>
              <tr class="table-primary">
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
          <td>{{$order->user->name}}</td>
        </tr>
        @endforeach
        <tr class="table-primary">
          <td colspan="7">
            <p>Liczba zrealizowanych zamówień: <strong>{{$quantityOrders}}</strong></p>
            <p>Wartość zrealizowanych zamówień: <strong>{{$valueOrders}} PLN</strong></p>
          </td>
        </tr>
      </tbody>
    </table>
    </div>
    @endif
        @if($repType==3)
        <table class="table table-bordered table-responsive-sm">
          <thead>
            <tr class="table-primary">
              <th scope="col">Pracownik</th>
              <th scope="col">Ilość zamówień</th>
              <th scope="col">Wartość zamówień</th>
            </tr>
          </thead>
          <tbody>
          @foreach($showOrders as $orders)
          <tr>
            <td>{{$orders->employee}}</td>
            <td>{{$orders->quantity}}</td>
            <td>{{$orders->value}}</td>
          </tr>
          @endforeach
        </tbody>
        </table>
        @endif
      @endif
  </div>
  </div>
</div>
@endsection
