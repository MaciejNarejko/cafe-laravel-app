<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Menu;

use App\Size;

use App\Type;

class MenuController extends Controller
{
  public function getItems(){
    $allItems = Menu::paginate(4);
    return view ('/menu/list-items',['menus' => $allItems]);
  }

  public function addItem(){
    $allTypes = Type::all();
    $allSizes = Size::all();
    return view ('/menu/add-item',['types' => $allTypes],['sizes' => $allSizes]);
  }

  public function createItem(Request $request){
     $request -> validate([
       'price' => 'required',
     ]);
    $item = new Menu();
    $item -> price = $request -> input('price');
    $item -> id_type = $request -> input('typeItem');
    $item -> id_size = $request -> input('sizeItem');
    $item -> save();
    return redirect()->route('items.list')->with('success','Pozycja dodana pomyślnie.');
  }

  public function deleteItem($id){
    Menu::where('id',$id)->delete();
    return redirect()->route('items.list')->with('success','Pozycja skasowana pomyślnie.');
  }

  public function updateItem(Request $request){
    $request -> validate([
      'price' => 'required',
    ]);
    $item = Menu::where('id',$request->id)->first();
    $item -> price = $request-> price;
    $item -> id_type = $request-> typeItem;
    $item -> id_size = $request-> sizeItem;
    $item -> save();
    return redirect()->route('items.list')->with('success','Pozycja został pomyślnie zaktualizowany.');
  }

  public function editItem($id){
    $types = Type::all();
    $sizes = Size::all();
    $item = Menu::where('id',$id)->first();
    return view('/menu/edit-item',['item'=> $item],['sizes' => $sizes]);
  }
}
