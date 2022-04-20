@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <h3>Edycja kategorii</h3>
        <a href="/categories/list-category">
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
        <form method="GET" action="{{route('category.update')}}">
          @csrf
          <input type="hidden" name="id" value="{{$category->id}}"/>
          <div class="form-group">
              <label for="category_name">Nazwa kategorii</label>
              <input type="text" name="categoryName" class="form-control" value="{{$category->name}}"/>
          </div>
          <input type="submit" value="Aktualizuj kategorię"/>
        </form>
      </div>
    </div>
  </div>
@endsection
