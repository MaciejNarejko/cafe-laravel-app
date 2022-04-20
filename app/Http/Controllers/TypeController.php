<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Type;

use App\Category;

class TypeController extends Controller
{
  public function getTypes(){
    $allTypes =  Type::paginate(4);
    return view ('/types/list-types',['types' => $allTypes]);
  }

  public function addType(){
    $categories = Category::all();
    return view ('/types/add-type',['categories' => $categories]);
  }

  public function createType(Request $request){
    $request -> validate([
      'typeName' => 'required',
    ]);

    $pictureName = "nophoto.jpg";
    $request->validate([
      'picture' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048'
    ]);
    if($request->picture){

      $pictureName = time().uniqid().'.'.$request->picture->extension();
      $request->picture->move(public_path('pictures'), $pictureName);
    }
    $types = new Type();
    $types -> name = $request -> input('typeName');
    $types -> id_category = $request -> input('categoryName');
    $types -> details = $request -> input('description');
    $types-> picture = $pictureName;
    $types -> save();
    return redirect()->route('types.list')->with('success','Typ dodany pomyślnie.');
  }

  public function deleteType($id){
    Type::where('id',$id)->delete();
    return redirect()->route('types.list')->with('success','Typ skasowany pomyślnie.');
  }

  public function updateType(Request $request){
    $request -> validate([
      'typeName' => 'required',
    ]);
    $types = Type::where('id',$request->id)->first();
    if($request->picture){
        $request->validate([
            'picture' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        if($types->picture != "nophoto.jpg"){
            $pictureName = $types->picture;
            unlink(public_path('pictures').'/'.$pictureName);
        }
        $pictureName = date('mdYHis').uniqid().'.'.$request->picture->extension();
        $request->picture->move(public_path('pictures'), $pictureName);
    }else{
        $pictureName = $types-> picture;
    }

    $types -> name = $request -> input('typeName');
    $types -> id_category = $request -> input('categoryName');
    $types -> details = $request -> input('description');
    $types-> picture = $pictureName;
    $types -> save();
    return redirect()->route('types.list')->with('success','Typ został pomyślnie zaktualizowany.');
  }

  public function editType($id){
    $categories = Category::all();
    $type = Type::where('id',$id)->first();
    return view('/types/edit-type',['type'=> $type],['categories' => $categories]);
  }
}
