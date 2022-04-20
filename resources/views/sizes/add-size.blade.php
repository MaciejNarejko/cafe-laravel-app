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
        <h3>Dodawanie rozmiaru</h3>
        <a href="/sizes/list-sizes">
          <i class="fa fa-angle-left" aria-hidden="true"></i> Wróć
        </a>
        <form action="{{route('size.add')}}" method="POST">
          @csrf
          <div class="form-group">
            <label for="sizeNameLabel">Rozmiar</label>
              <input type="text" name="sizeName" class="form-control" placeholder="Podaj rozmiar...">
          </div>
          <div class="form-group">
            <label for="volumeLabel">Objętość</label>
              <input type="text" name="volume" class="form-control" placeholder="Podaj objętość...">
          </div>
         <input type="submit" value="Dodaj rozmiar"/>
        </form>
      </div>
    </div>
  </div>
@endsection
