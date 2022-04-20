<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class ChangePasswordController extends Controller
{
    public function index() {
      return view('auth.passwords.change');
    }

    public function changePassword(Request $request){
      $request -> validate([
        'curPassword' => 'required',
        'password' => 'required|confirmed',
      ]);

      $hidenPassword = Auth::user()->password;
      if (Hash::check($request->curPassword,$hidenPassword)){
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('changePassword')->with('success','Hasło zostało zmienione.');
      }
      //return $hidenPassword;
    }

}
