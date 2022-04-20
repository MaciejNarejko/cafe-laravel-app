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
        <h3>Dodawanie użytkownika</h3>
        <a href="/users/list-users">
          <i class="fa fa-angle-left" aria-hidden="true"></i> Wróć
        </a>
        <form action="{{route('user.add')}}" method="POST">
          @csrf
          <div class="form-group">
           <label for="EmailUserLabel">Email</label>
           <input type="text" name="email" class="form-control" placeholder="Podaj adres email...">
          </div>
          <div class="form-group">
            <label for="UserLabel">Nazwa</label>
            <input type="text" name="name" class="form-control" placeholder="Podaj nazwę...">
          </div>
          <div class="form-group">
           <label for="PasswordUserLabel">Hasło</label>
           <input type="password" name="password" class="form-control" placeholder="Podaj hasło...">
          </div>
          <div class="form-group">
            <label for="positionUserLabel">Stanowisko</label>
           <select class="form-control" name="group">
                 <option value = "1">pracownik</option>
                 <option value = "2">manager</option>
           </select>
          </div>
         <input type="submit" value="Dodaj użytkownika"/>
        </form>
      </div>
    </div>
  </div>
@endsection
