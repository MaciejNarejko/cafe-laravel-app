@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <h3>Edycja użytkownika</h3>
        <a href="/users/list-users">
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
        <form method="PUT" action="{{route('user.update')}}">
          @csrf
          <input type="hidden" name="id" value="{{$user->id}}"/>
          <div class="form-group">
            <label for="emailUserLabel">Email</label>
              <input type="text" name="email" class="form-control" placeholder="Email..." value="{{$user->email}}">
          </div>
          <div class="form-group">
            <label for="NameLabel">Nazwa</label>
              <input type="text" name="name" class="form-control" value="{{$user->name}}">
          </div>
          <div class="form-group">
               <label for="positionUserLabel">Funkcja</label>
               <select class="form-control" name="group">
                     <option value = "1" @if($user->id_group=='1') selected='selected' @endif>pracownik</option>
                     <option value = "2"  @if($user->id_group=='2') selected='selected' @endif>manager</option>
               </select>
         </div>
         <div class="form-group">
           <label for="passwordUserLabel">Hasło</label>
             <input type="password" name="password" class="form-control">
         </div>
          <input type="submit" value="Aktualizuj dane"/>
        </form>
      </div>
    </div>
  </div>
@endsection
