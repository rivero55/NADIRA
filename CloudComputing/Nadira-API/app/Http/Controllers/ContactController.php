<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Hospital;
use Exception;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    function store(Request $request)
    {
        $object = new Contact();
        $rules = [
            "name" => "required",
            "deskripsi" => "required",
            "photo" => "required",
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);
        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/contact/";
            $savePathDB = "/web_files/contact/$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $object->photo_path = $savePathDB;
        }


        $object->name = $request->name;
        $object->deskripsi = $request->deskripsi;
        $object->save();

        if ($object) {
            return response()->json([
                'http_response' => 200,
                'status' => 1,
                'message' => 'Berhasil Menyimpan Kontak',
                'object' => $object
            ]);
        } else {
            return response()->json([
                'http_response' => 400,
                'status' => 0,
                'message' => 'Gagal Menambah Kontak',
                'object' => $object
            ]);
        }
    }
    function update(Request $request, $id)
    {
        $object = Hospital::findOrFail($id);
        $rules = [
            "name" => "required",
            "alamat" => "required",
            "deskripsi" => "required",
            "operasional" => "required",
            "kontak_rs" => "required",
            "kontak_ambulance" => "required",
            "lat" => "required",
            "long" => "required",
            "fasilitas" => "required",
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);
        $file_path = public_path() . $object->photo_path;

        if ($request->hasFile('photo')) {

            if (file_exists($file_path)) {
                try {
                    unlink($file_path);
                } catch (Exception $e) {
                }
            }

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/hospital/";
            $savePathDB = "/web_files/hospital/$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $object->photo_path = $savePathDB;
        }


        $object->name = $request->name;
        $object->alamat = $request->alamat;
        $object->deskripsi = $request->deskripsi;
        $object->operasional = $request->operasional;
        $object->fasilitas = $request->fasilitas;
        $object->kontak_rs = $request->kontak_rs;
        $object->kontak_ambulance = $request->kontak_ambulance;
        $object->lat = $request->lat;
        $object->long = $request->long;
        $object->save();

        if ($object) {
            return response()->json([
                'http_response' => 200,
                'status' => 1,
                'message' => 'Berhasil Mengupdate Rumah Sakit',
                'object' => $object
            ]);
        } else {
            return response()->json([
                'http_response' => 400,
                'status' => 0,
                'message' => 'Gagal Mengupdate Rumah Sakit',
                'object' => $object
            ]);
        }
    }

    public function fetch()
    {
        $object = Contact::all();
        return response()->json([
            'http_response' => 200,
            'status' => 1,
            'length' => $object->count(),
            'message' => 'Berhasil Menampilkan Data Kontak',
            'data' => $object
        ]);
    }

    public function getByID($id)
    {
        $object = Contact::findOrFail($id);
        return response()->json([
            'http_response' => 200,
            'status' => 1,
            'message' => 'Berhasil Menampilkan Detail Kontak',
            'data' => $object
        ]);
    }
    public function delete($id)
    {
        $object = Contact::findOrFail($id);
        $file_path = public_path() . $object->photo_path;
        if (file_exists($file_path)) {
            try {
                unlink($file_path);
            } catch (Exception $e) {
            }
        }
        $object->delete();
        if ($object) {
            return response()->json([
                'http_response' => 200,
                'status' => 1,
                'message' => 'Berhasil menghapus Data Kontak',
                'data' => $object
            ]);
        } else {
            return response()->json([
                'http_response' => 200,
                'status' => 0,
                'message' => 'Gagal menghapus Data Kontak',
                'data' => $object
            ]);
        }
    }
}
