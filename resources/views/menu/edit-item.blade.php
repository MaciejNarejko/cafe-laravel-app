@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <h3>Edycja pozycji</h3>
        <a href="/menu/list-items">
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
        <form method="GET" action="{{route('item.update')}}">
          @csrf
          <input type="hidden" name="id" value="{{$item->id}}"/>
          <input type="hidden" name="typeItem" value="{{$item->id_type}}"/>
          <div class="form-group">
            <label for="TypeLabel">Produkt</label>
              <input type="text" name="type" class="form-control" value="{{$item->type->category->name}} {{$item->type->name}}" readonly>
          </div>
         <div class="form-group">
              <label for="SizeLabel">Wielkość</label>
              <select class="form-control" name="sizeItem">
                @foreach ($sizes as $size)
                    <option value = "{{$size->id}}"> {{$size->name}} </option>
                 @endforeach
              </select>
        </div>
          <div class="form-group">
            <label for="PriceLabel">Cena</label>
              <input type="text" name="price" class="form-control" value="{{$item->price}}">
          </div>
          <input type="submit" value="Aktualizuj pozycję"/>
        </form>
      </div>
    </div>
  </div>
@endsection
