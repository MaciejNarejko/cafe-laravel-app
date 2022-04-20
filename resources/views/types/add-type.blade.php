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
        <h3>Dodawanie typu</h3>
        <a href="/types/list-types">
          <i class="fa fa-angle-left" aria-hidden="true"></i> Wróć
        </a>
        <form action="{{route('type.add')}}" method="POST" enctype="multipart/form-data">
          @csrf
        <div class="form-group">
            <label for="typeNameLabel">Nazwa typu</label>
              <input type="text" name="typeName" class="form-control" placeholder="Podaj typ...">
        </div>
        <div class="form-group">
               <label for="categoryNameLabel">Kategoria</label>
               <select class="form-control" name="categoryName">
                 @foreach ($categories as $category)
                     <option value = "{{$category->id}}">{{$category->name}}</option>
                  @endforeach
               </select>
        </div>
        <div class="form-group">
           <label for="detailsLabel">Opis</label>
             <input type="text" name="description" class="form-control" placeholder="Podaj opis...">
        </div>
        <label for="detailsLabel">Zdjęcie</label>
        <div class="form-group">
          <input type="file" name="picture" class="form-control-file" id="exampleFormControlFile1">
        </div>

         <input type="submit" value="Dodaj typ"/>
        </form>
      </div>
    </div>
  </div>
@endsection
