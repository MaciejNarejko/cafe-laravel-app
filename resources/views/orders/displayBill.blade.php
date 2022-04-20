@extends('layouts.app')

@section('content')

  <div class="bill container">
    <div class="screen">
      <button class="btn btn-primary print" type="button" onclick="window.print(); ">
        Drukuj
      </button>
      <a href="/">
      <button class="btn btn-primary print" type="button">
        Wróć
      </button>
      </a>
    </div>
    <div class="print">
    <div class="row">
      <div class="col-sm-4 main">
        <div class"bill" id="header">
          <hr>
          <h5>Rachunek</h5>
          <hr>
          <h5>Kawiarnia Zakątek</h5>
          <h7>Maciej Narejko</h7>
          <br>
          <h7>Ul. Zielonych Łąk 4, 03-801 Warszawa</h7>
          <br>
          <h7>Infolinia: +48 729 105 ***</h7>
          <br>
          <h7>www.zielony.zakątek</h7>
          <br>
          <h7 id="nip">NIP: 999-xx-10-xx</h7>
          <hr>
          <h5>Pozycje</h5>
          <hr>
        </div>
        <div class"bill" id="body">


          <table class="table table-borderless bill table-responsive">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Pozycja</th>
                <th scope="col">Ilość</th>
                <th scope="col">Cena szt.</th>
              </tr>
            </thead>
            <tbody>
              @foreach($positions as $position)
              <tr>
                <td scope="row"></td>
                <td>{{$position->menu->type->category->name}} {{$position->menu->type->name}} {{$position->menu->size->name}}</td>
                <td>{{$position->quantity}}</td>
                <td>{{$position->menu->price}} PLN</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <hr>
          <div class="rowsummary">
            <div class="row">
              <div class="col-sm sum">
                <h5>Suma:</h5>
              </div>
              <div class="col-sm raz">
                <h5>{{$orders->order_value}} PLN</h5>
              </div>
          </div>
            <hr>
          <div class"bill" id="footer">
            Zamówienie: {{$orders->id}}
            <br>
            Pracownik: {{$orders->user->name}}
            <br>
            {{$orders->updated_at}}
            <br>
            Płatność: {{$orders->payment->method}}
            <br>
            Dziękujemy za odwiedzenie kawiarni!
          </div>
        </div>
      </div>
    </div>
    </div>

@endsection
