@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <h3>Edycja stolika</h3>
        <a href="/tables/list-tables">
          <i class="fa fa-angle-left" aria-hidden="true"></i> Wróć
        </a>
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
        <form method="GET" action="{{route('table.update')}}">
          @csrf
          <input type="hidden" name="id" value="{{$table->id}}"/>
          <div class="form-group">
            <label for="tableNameLabel">Nazwa stolika</label>
              <input type="text" name="tableName" class="form-control" placeholder="Podaj nazwę stolika..." value="{{$table->name}}">
          </div>
          <div class="form-group">
               <label for="tableNameLabel">Maksymalna liczba osób</label>
               <select class="form-control" name="capacity">
                     <option value = "1" @if($table->capacity=='1') selected='selected' @endif>1</option>
                     <option value = "2"  @if($table->capacity=='2') selected='selected' @endif>2</option>
                     <option value = "3"  @if($table->capacity=='3') selected='selected' @endif>3</option>
                     <option value = "4"  @if($table->capacity=='4') selected='selected' @endif>4</option>
                     <option value = "5"  @if($table->capacity=='5') selected='selected' @endif>5</option>
                     <option value = "6"  @if($table->capacity=='6') selected='selected' @endif>6</option>
                     <option value = "7"  @if($table->capacity=='7') selected='selected' @endif>7</option>
               </select>
         </div>
         <div class="form-group">
           <label for="tableNameLabel">Dostępność dla gości</label>
            <select class="form-control" name="availability">
                  <option value = "1"  @if($table->availability=='1') selected='selected' @endif>Dostępny</option>
                  <option value = "0"  @if($table->availability=='0') selected='selected' @endif>Niedostępny</option>
            </select>
         </div>
          <input type="submit" value="Aktualizuj stolik"/>
        </form>
      </div>
    </div>
  </div>
@endsection
