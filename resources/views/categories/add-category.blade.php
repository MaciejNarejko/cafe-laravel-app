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
        <h3>Dodawanie kategorii</h3>
        <a href="/categories/list-category">
          <i class="fa fa-angle-left" aria-hidden="true"></i> Wróć
        </a>
        <form method="POST" action="{{route('category.add')}}">
          @csrf
          <div class="form-group">
              <label for="categoryNameLabel">Nazwa kategorii</label>
              <input type="text" name="categoryName" class="form-control" placeholder="Podaj nazwę kategorii...">
          </div>
          <input type="submit" value="Add Category"/>
        </form>
      </div>
    </div>
  </div>
@endsection
