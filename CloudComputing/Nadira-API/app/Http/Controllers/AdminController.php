<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     //Login via API
     public function login(Request $request)
     {
         $rules = [
             'username' => 'required',
             'password' => 'required',
         ];
 
         $customMessages = [
             'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
         ];
 
         $this->validate($request, $rules, $customMessages);
 
         if (Auth::guard('admin')->attempt(
             [
                 'email' => $request->username,
                 'password' => $request->password
             ],
             $request->get('remember')
         )) {
             $id = Auth::guard('admin')->id();
             $people = Admin::findOrFail($id);
             return response()->json([
                 'http_response' => 200,
                 'status' => 1,
                 'message_id' => 'Login Berhasil',
                 'message' => 'Login Successfull',
                 'people' => $people,
             ]);
         } else {
             return response()->json([
                 'http_response' => 400,
                 'status' => 0,
                 'message_id' => 'Login Gagal',
                 'message' => 'Login Failed',
             ]);
         }
         return back()->withInput($request->only('nisn', 'remember'));
     }
 
}
