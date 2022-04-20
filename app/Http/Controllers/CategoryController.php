<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


use App\Category;

class CategoryController extends Controller
{
    public function addCategory (){
      return view ('/categories/add-category');
    }

    public function createCategory(Request $request){
      $request -> validate([
        'categoryName' => 'required|unique:categories,name'
      ]);
      $category = new Category();
      $category -> name = $request -> input('categoryName');
      $category -> save();
      return redirect()->route('category.list')->with('success','Kategoria dodana pomyślnie.');
    }

    public function getCategories(){
      $categories = Category::all();
      return view ('/categories/list-category',['categories' => $categories]);
    }

    public function deleteCategory($id){
      Category::where('id',$id)->delete();
      return redirect()->route('category.list')->with('success','Kategoria skasowana pomyślnie.');
    }

    public function updateCategory(Request $request){
      $request -> validate([
        'categoryName' => 'required|unique:categories,name'
      ]);
      $categories = Category::where('id',$request->id)->first();
      $categories -> name = $request-> categoryName;
      $categories -> save();
      return redirect()->route('category.list')->with('success','Kategoria została pomyślnie zaktualizowana.');
    }

    public function editCategory($id){
      $category = Category::where('id',$id)->first();
      return view('/categories/edit-category',['category'=> $category]);
    }
}
