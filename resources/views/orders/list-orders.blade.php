@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h4>Zamówienia nieopłacone</h4>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Stolik</th>
              <th>Pracownik</th>
              <th>Wartość zamówienia</th>
              <th>Status</th>
              <th>Data zamówienia</th>
              <th>Operacje</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
              <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->table->name}}</td>
                <td>{{$order->id_user}}</td>
                <td>{{$order->order_value}}</td>
                <td>{{$order->status}}</td>
                <td>{{$order->created_at}}</td>
                <td>
                  <div class="operacje">
                    <div class="op">
                    <a  class ="edit" href="">
                      <i class="fa fa-pencil" aria-hidden="true"></i> Edytuj
                    </a>
                  </div>
                  <div class="op">
                    <a class ="delete" href="" onclick="return confirm('Czy na pewno chcesz usunąć ten rozmiar?');">
                      <i class="fa fa-trash" aria-hidden="true"></i> Usuń
                    </a>
                  </div>
                  </div>
                </td>
              </tr>
            @endforeach
      </div>
    </div>
  </div>
@endsection
