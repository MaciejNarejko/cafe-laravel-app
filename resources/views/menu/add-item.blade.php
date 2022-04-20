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
        <h3>Dodawanie Pozycji</h3>
        <a href="/menu/list-items">
          <i class="fa fa-angle-left" aria-hidden="true"></i> Wróć
        </a>
        <form action="{{route('item.add')}}" method="POST">
          @csrf
          <div class="form-group">
               <label for="TypeLabel">Przedmiot</label>
               <select class="form-control" name="typeItem">
                 @foreach ($types as $type)
                     <option value = "{{$type->id}}">{{$type->category->name}} {{$type->name}}</option>
                  @endforeach
               </select>
         </div>
          <div class="form-group">
               <label for="SizeLabel">Wielkość</label>
               <select class="form-control" name="sizeItem">
                 @foreach ($sizes as $size)
                     <option value = "{{$size->id}}"> {{$size->name}}  {{$size->volume}}</option>
                  @endforeach
               </select>
         </div>
          <div class="form-group">
            <label for="PriceLabel">Cena</label>
              <input type="text" name="price" class="form-control" placeholder="Podaj cenę np. 10.99">
          </div>
         <input type="submit" value="Dodaj pozycję"/>
        </form>
      </div>
    </div>
  </div>
@endsection
