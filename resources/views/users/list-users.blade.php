@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1>Wszyscy użytkownicy</h1>
        <a href="/users/add-user">
          <i class="fa fa-plus" aria-hidden="true"></i> Dodaj nowego użytkownika
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
              <th>Nazwa</th>
              <th>Email</th>
              <th>Funkcja</th>
              <th>Operacje</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $person)
              <tr>
                <td>{{$person->id}}</td>
                <td>{{$person->name}}</td>
                <td>{{$person->email}}</td>
                <td>{{$person->group->name}}</td>
                <td>
                  <div class="operacje">
                    <div class="op">
                    <a  class ="edit" href="/users/edit-user/{{$person->id}}">
                      <i class="fa fa-pencil" aria-hidden="true"></i> Edytuj
                    </a>
                  </div>
                  <div class="op">
                    <a class ="delete" href="/users/delete-user/{{$person->id}}" onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?');">
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
