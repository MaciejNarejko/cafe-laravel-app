@extends('layouts.app')

@section('content')
  <div class="container types">
    <div class="row">
      <div class="col-sm-12">
        <h1>Wszystkie typy</h1>
        <a href="/types/add-type">
          <i class="fa fa-plus" aria-hidden="true"></i> Dodaj Typ
        </a>
        @if($notification = Session::get('success'))
          <div class="alert alert-success">
            {{ $notification}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <table class="table table-bordered table-responsive-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Picture</th>
              <th>Typ</th>
              <th>Kategoria</th>
              <th>Opis</th>
              <th>Operacja</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($types as $type)
              <tr>
                <td>{{$type->id}}</td>
                <td><img src="{{asset('pictures')}}/{{$type->picture}}" width="100px" height="100px" class="img-thumbnail"></td>
                <td>{{$type->name}}</td>
                <td>{{$type->category->name}}</td>
                <td>{{$type->details}}</td>

                <td>
                  <div class="operacje">
                    <div class="op">
                    <a  class ="edit" href="/types/edit-type/{{$type->id}}">
                      <i class="fa fa-pencil" aria-hidden="true"></i> Edytuj
                    </a>
                  </div>
                  <div class="op">
                    <a class ="delete" href="/types/delete-type/{{$type->id}}" onclick="return confirm('Czy na pewno chcesz usunąć ten typ?');">
                      <i class="fa fa-trash" aria-hidden="true"></i> Usuń
                    </a>
                  </div>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{$types->links()}}
      </div>
    </div>
  </div>
@endsection
