@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1>Wszystkie rozmiary</h1>
        <a href="/sizes/add-size">
          <i class="fa fa-plus" aria-hidden="true"></i> Dodaj nowy rozmiar
        </a>
        @if($notification = Session::get('success'))
          <div class="alert alert-success">
            {{ $notification}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Nazwa</th>
              <th>Objętość</th>
              <th>Operacje</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($sizes as $size)
              <tr>
                <td>{{$size->id}}</td>
                <td>{{$size->name}}</td>
                <td>{{$size->volume}}</td>
                <td>
                  <div class="operacje">
                    <div class="op">
                    <a  class ="edit" href="/sizes/edit-size/{{$size->id}}">
                      <i class="fa fa-pencil" aria-hidden="true"></i> Edytuj
                    </a>
                  </div>
                  <div class="op">
                    <a class ="delete" href="/sizes/delete-size/{{$size->id}}" onclick="return confirm('Czy na pewno chcesz usunąć ten rozmiar?');">
                      <i class="fa fa-trash" aria-hidden="true"></i> Usuń
                    </a>
                  </div>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
