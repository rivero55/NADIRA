<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\People;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PeopleController extends Controller
{
    function fetchAll()
    {
        $people = People::all();

        $response = array();
        $response['status'] = 1;
        $response['http_code'] = 1;
        $response['data_length'] = count($people);
        $response['data'] = $people;

        return response()->json([
            'message' => "Unauthorized, Api Key Mismatch",
            'http_response' => 401,
            'status_code' => 0,
        ], 401);
    }

    function updatePhotoByID(Request $request, $id)
    {
        $response = array();
        $user = People::findOrFail($id);

        if ($request->hasFile('photo')) {

            $file_path = public_path().$user->photo_path;
            if (file_exists($file_path)) {
                try{
                    unlink($file_path);
                }catch(Exception $e){

                }
            }
            
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = $user->id . '.' . $extension;

            $savePath = "/web_files/user_profile/$id/";
            $savePathDB = "/web_files/user_profile/$id/$fileName";
            $path = public_path() . "$savePath";
            $upload = $file->move($path, $fileName);

            $user->photo_path=$savePathDB;
            $user->save();

            if ($user && $user) {
                $response = [
                    'http_response' => 200,
                    'status_code' => 1,
                    'message_id' => 'Berhasil Mengupdate Foto Profil',
                    'message' => 'Success',
                ];
            }

          
        } else {
            $response = [
                'message' => "Photo should be provided",
                'http_response' => 401,
                'status_code' => 3,
            ];
        }

        return response()->json(
            $response
        );
    }


    function changePassword($id, Request $request)
    {
        $user_id = $id;

        $this->validate($request, [
            'new_password' => 'required|min:6',
            'old_password' => 'required|min:6'
        ]);

        $user = People::findOrFail($user_id);
        $hasher = app('hash');

        //If Password Sesuai
        if (!$hasher->check($request->old_password, $user->password)) {
            return response()->json([
                'http_response' => 400,
                'status' => 3,
                'message_id' => 'Password Lama Tidak Sesuai',
                'message' => 'Old Password did not match',
            ]);
        } else {
            $user->password = Hash::make($request->new_password);
            $user->save();

            if ($user) {
                return response()->json([
                    'http_response' => 200,
                    'status' => 1,
                    'user_id' => $user->id,
                    'message_id' => 'Password Berhasil Diupdate',
                    'message' => 'Password updated',
                ]);
            } else {
                return response()->json([
                    'http_response' => 400,
                    'status' => 0,
                    'message_id' => 'Password Gagal Diupdate',
                    'message' => 'Password Update Failed',
                ]);
            }
        }
    }



    /**
     * store the request sell
     *id	nama	username	email	nik 	password	jk	no_telp	photo_path	remember_token	created_at	updated_at	
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'jk' => 'required',
            'no_telp' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $object = new People();
        $object->nama = $request->nama;
        $object->username = $request->username;
        $object->email = $request->email;
        $object->password =  bcrypt($request->password);
        $object->jk = $request->jk;
        $object->no_telp = $request->no_telp;

        $object->save();


        if ($object) {
            return response()->json([
                'http_response' => 200,
                'status' => 1,
                'message_id' => 'Registrasi Berhasil, Silakan Login Menggunakan Akun Anda',
                'message' => 'Registration Success',
            ]);
        } else {
            return response()->json([
                'http_response' => 400,
                'status' => 0,
                'message_id' => 'Registrasi Gagal',
                'message' => 'Registration Failed',
            ]);
        }
    }

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

        if (str_contains($request->username,'@')) {
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
                    'type' => 'admin',
                    'message_id' => 'Login Berhasil (Admin)',
                    'message' => 'Login Successfull (Admin)',
                    'people' => $people,
                ]);
            } else {
                return response()->json([
                    'http_response' => 400,
                    'status' => 0,
                    'type' => 'admin',
                    'message_id' => 'Login Gagal (Admin)',
                    'message' => 'Login Failed (Admin)',
                ]);
            }
        }

        if (Auth::guard('people')->attempt(
            [
                'username' => $request->username,
                'password' => $request->password
            ],
            $request->get('remember')
        )) {
            $id = Auth::guard('people')->id();
            $people = People::findOrFail($id);
            return response()->json([
                'http_response' => 200,
                'status' => 1,
                'type' => 'people',
                'message_id' => 'Login Berhasil',
                'message' => 'Login Successfull',
                'people' => $people,
            ]);
        } else {
            return response()->json([
                'http_response' => 400,
                'status' => 0,
                'type' => 'people',
                'message_id' => 'Login Gagal',
                'message' => 'Login Failed',
            ]);
        }
        return back()->withInput($request->only('nisn', 'remember'));
    }

    function getUserByID($id)
    {
        $user = People::where('id', '=', $id)->count();
        if ($user == 0) {
            return response()->json([
                'http_response' => 404,
                'status' => 0,
                'message_id' => 'User Tidak Ditemukan',
                'message' => 'User Not Found',
            ]);
        } else {
            $user = People::find($id);
            return response()->json([
                'http_response' => 200,
                'status' => 1,
                'user' => $user,
                'message_id' => 'User Ditemukan',
                'message' => 'User Found',
            ]);
        }
    }
    function updateUserByID($id, Request $request)
    {

        $user = People::findOrFail($id);
        if ($request->nama  != null) {
            $user->nama = $request->nama;
        }
        if ($request->username  != null) {
            $user->username = $request->username;
        }
        if ($request->email  != null) {
            $user->email = $request->email;
        }
        if ($request->nik  != null) {
            $user->nik = $request->nik;
        }
        if ($request->no_telp != null) {
            $user->no_telp = $request->no_telp;
        }
        if ($request->jk != null) {
            $user->jk = $request->jk;
        }

        $user->update();

        if ($user) {
            $user = People::find($id);
            return response()->json([
                'http_response' => 200,
                'status' => 1,
                'message_id' => 'Berhasil Mengupdate Profile',
                'message' => 'User Found',
                'user' => $user,

            ]);
        } else {
            return response()->json([
                'http_response' => 404,
                'status' => 0,
                'message_id' => 'Gagal Mengupdate Profile',
                'message' => 'User Not Found',
            ]);
        }
    }
}
