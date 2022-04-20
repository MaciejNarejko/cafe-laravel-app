@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        @if ($errors->any())
          <div class="alert alert-danger" role="alert">
            <ul>
            @foreach ($errors->all() as $error)
                <li>
                  <strong>Błąd!</strong> {{ $error }}
                </li>
            @endforeach
            </ul>
          </div>
        @endif
        <h3>Dodawanie stolika</h3>
        <a href="/tables/list-tables">
          <i class="fa fa-angle-left" aria-hidden="true"></i> Wróć
        </a>
        <form action="{{route('table.add')}}" method="POST">
          @csrf
          <div class="form-group">
            <label for="tableNameLabel">Nazwa stolika</label>
              <input type="text" name="tableName" class="form-control" placeholder="Podaj nazwę stolika...">
          </div>
          <div class="form-group">
               <label for="tableNameLabel">Maksymalna liczba osób</label>
               <select class="form-control" name="capacity">
                     <option value = "1">1</option>
                     <option value = "2">2</option>
                     <option value = "3">3</option>
                     <option value = "4">4</option>
                     <option value = "5">5</option>
                     <option value = "6">6</option>
                     <option value = "7">7</option>
               </select>
         </div>
         <div class="form-group">
           <label for="tableNameLabel">Dostępność dla gości</label>
            <select class="form-control" name="availability">
                  <option value = "1">Dostępny</option>
                  <option value = "0">Niedostępny</option>
            </select>
         </div>
         <input type="submit" value="Dodaj stolik"/>
        </form>
      </div>
    </div>
  </div>
@endsection
