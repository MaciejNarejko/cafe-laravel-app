@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h1>Wszystkie kategorie</h1>
        <a href="/categories/add-category">
          <i class="fa fa-plus" aria-hidden="true"></i> Dodaj nową kategorię
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
              <th>No</th>
              <th>Nazwa kategorii</th>
              <th>Operacja</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $cat)
              <tr>
                <td>{{$cat->id}}</td>
                <td>{{$cat->name}}</td>
                <td>
                  <div class="operacje">
                    <a  class ="edit" href="/categories/edit-category/{{$cat->id}}">
                      <i class="fa fa-pencil" aria-hidden="true"></i> Edytuj
                    </a>
                    <a class ="delete" href="/categories/delete-category/{{$cat->id}}" onclick="return confirm('Czy na pewno chcesz usunąć tą kategorię?');">
                      <i class="fa fa-trash" aria-hidden="true"></i> Usuń
                    </a>
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
