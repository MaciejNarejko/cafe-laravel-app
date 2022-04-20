@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1>Wszystkie stoliki</h1>
        <a href="/tables/add-table">
          <i class="fa fa-plus" aria-hidden="true"></i> Dodaj nowy stolik
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
              <th>Nazwa stołu</th>
              <th>Max ilość osób</th>
              <th>Dostępność</th>
              <th>Operacja</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tables as $table)
              <tr>
                <td>{{$table->id}}</td>
                <td>{{$table->name}}</td>
                <td>{{$table->capacity}}</td>
                <td>@if($table->availability=='1') Dostępny @else Niedostępny @endif</td>

                <td>
                  <div class="operacje">
                    <div class="op">
                    <a  class ="edit" href="/tables/edit-table/{{$table->id}}">
                      <i class="fa fa-pencil" aria-hidden="true"></i> Edytuj
                    </a>
                  </div>
                  <div class="op">
                    <a class ="delete" href="/tables/delete-table/{{$table->id}}" onclick="return confirm('Czy na pewno chcesz usunąć ten stolik?');">
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
