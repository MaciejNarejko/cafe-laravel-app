<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Size;

class SizeController extends Controller
{
  public function getSizes(){
    $allSizes = Size::all();
    return view ('/sizes/list-sizes',['sizes' => $allSizes]);
  }

  public function addSize(){
    return view ('/sizes/add-size');
  }

  public function createSize(Request $request){
     $request -> validate([
       'sizeName' => 'required',
       'volume' => 'required'
     ]);
    $size = new Size();
    $size -> name = $request -> input('sizeName');
    $size -> volume = $request -> input('volume');
    $size -> save();
    return redirect()->route('sizes.list')->with('success','Rozmiar dodany pomyślnie.');
  }

  public function deleteSize($id){
    Size::where('id',$id)->delete();
    return redirect()->route('sizes.list')->with('success','Rozmiar skasowany pomyślnie.');
  }

  public function updateSize(Request $request){
    $request -> validate([
      'sizeName' => 'required',
      'volume' => 'required'
    ]);
    $size = Size::where('id',$request->id)->first();
    $size -> name = $request-> sizeName;
    $size -> volume = $request-> volume;
    $size -> save();
    return redirect()->route('sizes.list')->with('success','Rozmiar został pomyślnie zaktualizowany.');
  }

  public function editSize($id){
    $size = Size::where('id',$id)->first();
    return view('/sizes/edit-size',['size'=> $size]);
  }
}
