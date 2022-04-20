<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Table;

class TableController extends Controller
{
  public function getTables(){
    $allTables = Table::all();
    return view ('/tables/list-tables',['tables' => $allTables]);
  }

  public function addTable(){
    return view ('/tables/add-table');
  }

  public function createTable(Request $request){
     $request -> validate([
       'tableName' => 'required|unique:tables,name',
       'availability' => 'required',
       'capacity' => 'required'
     ]);
    $table = new Table();
    $table -> name = $request -> input('tableName');
    $table -> availability = $request ->input('availability');
    $table -> capacity = $request -> input('capacity');
    $table -> save();
    return redirect()->route('tables.list')->with('success','Stolik dodany pomyślnie.');
  }

  public function deleteTable($id){
    Table::where('id',$id)->delete();
    return redirect()->route('tables.list')->with('success','Stolik skasowany pomyślnie.');
  }

  public function updateTable(Request $request){
    $request -> validate([
      'tableName' => 'required',
      'availability' => 'required',
      'capacity' => 'required'
    ]);
    $tab = Table::where('id',$request->id)->first();
    $tab -> name = $request-> tableName;
    $tab -> availability = $request-> availability;
    $tab -> capacity = $request-> capacity;
    $tab -> save();
    return redirect()->route('tables.list')->with('success','Stolik został pomyślnie zaktualizowany.');
  }

  public function editTable($id){
    $table = Table::where('id',$id)->first();
    return view('/tables/edit-table',['table'=> $table]);
  }
}
