@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <h3>Edycja rozmiaru</h3>
        <a href="/sizes/list-sizes">
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
        <form method="GET" action="{{route('size.update')}}">
          @csrf
          <input type="hidden" name="id" value="{{$size->id}}"/>
          <div class="form-group">
            <label for="sizeNameLabel">Rozmiar</label>
              <input type="text" name="sizeName" class="form-control" value="{{$size->name}}">
          </div>
          <div class="form-group">
            <label for="volumeLabel">Objętość</label>
              <input type="text" name="volume" class="form-control" value="{{$size->volume}}">
          </div>
          <input type="submit" value="Aktualizuj rozmiar"/>
        </form>
      </div>
    </div>
  </div>
@endsection
