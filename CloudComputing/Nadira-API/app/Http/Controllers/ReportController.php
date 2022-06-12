<?php

namespace App\Http\Controllers;

use App\Models\Admin as ModelsAdmin;
use App\Models\People;
use App\Models\Report;
use Exception;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * store the request sell
     *id	nama	username	email	nik 	password	jk	no_telp	photo_path	remember_token	created_at	updated_at
     */
    public function store(Request $request)
    {
        $rules = [
            'id_people' => 'required|numeric',
            'id_category' => 'required|numeric',
            'is_public' => 'required|numeric',
            'detail_kejadian' => 'required',
            'detail_alamat' => 'required',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
            'photo' => 'required|file',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $object = new Report();


        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/report_photo/";
            $savePathDB = "/web_files/report_photo/$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);
            $object->photo_path = $savePathDB;
        }

        $noLaporan = "JS" . $request->id_category . time() . $request->id_people;


        $object->no_laporan = $noLaporan;
        $object->detail_kejadian = $request->detail_kejadian;
        $object->detail_alamat = $request->detail_alamat;
        $object->lat = $request->lat;
        $object->long = $request->long;
        $object->is_public = $request->is_public;
        $object->status = 0;
        $object->status_desc = "Menunggu Diproses";
        $object->id_staff = null;
        $object->id_people = $request->id_people;
        $object->id_category = $request->id_category;

        $object->tanggal_kejadian = $request->tanggal_kejadian;
        $object->waktu_kejadian = $request->waktu_kejadian;
        $object->peyebab_kejadian = $request->penyebab_bencana;

        $object->kerusakan_bangunan = $request->kerusakan_bangunan;
        $object->kerusakan_lain = $request->kerusakan_lain;
        $object->korban_jiwa = $request->korban_jiwa;
        $object->kondisi_korban = $request->kondisi_korban;
        $object->save();


        if ($object) {
            return response()->json([
                'http_response' => 200,
                'status' => 1,
                'message_id' => 'Report Berhasil Dilaporkan Ke Sistem',
                'message' => 'Report Berhasil Dilaporkan Ke Sistem',
                'data' => $object,
            ]);
        } else {
            return response()->json([
                'http_response' => 400,
                'status' => 0,
                'message_id' => 'Report Gagal Dilaporkan Ke Sistem',
                'message' => 'Report Gagap Dilaporkan Ke Sistem',
            ]);
        }
    }

    public function getByUsers(Request $request, $id)
    {
        $paginate = $request->paginate;
        if ($paginate == null) {
            $paginate = 9999999;
        }

        $pageNumber = $request->page_number;


        $report = Report::where('id_people', '=', $id)->orderBy('created_at','desc')
        ->paginate($paginate, ['*'], 'page', $pageNumber);

        if ($id=="all" || $id==null) {
            $report = Report::where('id_people', '<>', 0)->orderBy('created_at','desc')
            ->paginate($paginate, ['*'], 'page', $pageNumber);

        }

        return response()->json([
            'http_response' => 200,
            'status' => 1,
            'message_id' => 'Berhasil Mendapatkan Data Report',
            'message' => 'Berhasil Mendapatkan Data Report',
            'report' => $report,
        ], 200);
    }

    public function delete($id){

        $report=Report::find($id);
        if ($report==null) {
            return response()->json([
                'http_response' => 400,
                'status' => 0,
                'message_id' => 'Gagal Menghapus Report, Report Tidak Ditemukan',
                'message' => 'Gagal Menghapus Report, Report Tidak Ditemukan',
                'report' => $report,
            ], 400);
        }else{

            $file_path = public_path().$report->photo_path;
            if (file_exists($file_path)) {
                try{
                    unlink($file_path);
                }catch(Exception $e){

                }
            }
            $report->delete();
            if ($report) {
                return response()->json([
                    'http_response' => 200,
                    'status' => 1,
                    'message_id' => 'Berhasil Menghapus Data Report',
                    'message' => 'Berhasil Menghapus Data Report',
                    'report' => $report,
                ], 200);
            }else{
                return response()->json([
                    'http_response' => 200,
                    'status' => 1,
                    'message_id' => 'Gagal Menghapus Data Report',
                    'message' => 'Gagal Menghapus Data Report',
                    'report' => $report,
                ], 200);
            }
        }
    }
    public function getByID($id){

        $report=Report::find($id);
        if ($report==null) {
            return response()->json([
                'http_response' => 400,
                'status' => 0,
                'message_id' => 'Gagal Menemukan Report',
                'message' => 'Gagal Menemukan Report',
                'report' => $report,
            ], 400);
        }else{
            if ($report) {
                return response()->json([
                    'http_response' => 200,
                    'status' => 1,
                    'message_id' => 'Berhasil Mendapatkan Data Report',
                    'message' => 'Berhasil Mendapatkan Data Report',
                    'report' => $report,
                ], 200);
            }else{
                return response()->json([
                    'http_response' => 400,
                    'status' => 1,
                    'message_id' => 'Gagal Mendapatkan Data Report',
                    'message' => 'Gagal Mendapatkan Data Report',
                    'report' => $report,
                ], 400);
            }
        }
    }



}
