<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use app\User;

use app\Groups;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function getUsers(){
  $allUsers = User::all();
  return view ('/users/list-users',['users' => $allUsers]);
  }

  public function addUser(){
    return view ('/users/add-user');
  }

  public function createUser(Request $request){
     $request -> validate([
       'name' => 'required|unique:users|max:120',
       'email' => 'required|email|unique:users|max:120',
       'group' => 'required',
       'password' => 'required|min:8'
     ]);
    $staff = new User();
    $staff -> name = $request -> input('name');
    $staff -> email = $request -> input('email');
    $staff -> id_group = $request -> input('group');
    $staff -> password = Hash::make($request->password);
    $staff -> save();
    return redirect()->route('users.list')->with('success','Użytkownik dodany pomyślnie.');
  }

  public function deleteUser($id){
    User::where('id',$id)->delete();
    return redirect()->route('users.list')->with('success','Użytkownik skasowany pomyślnie.');
  }

  public function updateUser(Request $request){
    $request -> validate([
      'name' => 'required|max:120',
      'email' => 'required|email|max:120',
      'group' => 'required',
      'password' => 'required|min:8'
    ]);

    $staff = User::where('id',$request->id)->first();
    $staff -> name = $request -> input('name');
    $staff -> email = $request -> input('email');
    $staff -> id_group = $request -> input('group');
    $staff -> password = Hash::make($request->password);
    $staff -> save();
    return redirect()->route('users.list')->with('success','Użytkownik został pomyślnie zaktualizowany.');
  }

  public function editUser($id){
    $staff = User::where('id',$id)->first();
    return view('/users/edit-user',['user'=> $staff]);
  }
}
