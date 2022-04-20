@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1>Menu</h1>
        <a href="/menu/add-item">
          <i class="fa fa-plus" aria-hidden="true"></i> Dodaj nową pozycję
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
              <th>Produkt</th>
              <th>Rozmiar</th>
              <th>Cena</th>
              <th>Operacja</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($menus as $item)
              <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->type->category->name}} {{$item->type->name}}</td>
                <td>{{$item->size->name}}</td>
                <td>{{$item->price}}</td>
                <td>
                  <div class="operacje">
                    <div class="op">
                    <a  class ="edit" href="/menu/edit-item/{{$item->id}}">
                      <i class="fa fa-pencil" aria-hidden="true"></i> Edytuj
                    </a>
                  </div>
                  <div class="op">
                    <a class ="delete" href="/menu/delete-item/{{$item->id}}" onclick="return confirm('Czy na pewno chcesz usunąć tą pozycję?');">
                      <i class="fa fa-trash" aria-hidden="true"></i> Usuń
                    </a>
                  </div>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{$menus->links()}}
      </div>
    </div>
  </div>
@endsection
