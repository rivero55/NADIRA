<?php

namespace App\Http\Controllers;

use App\Models\Admin as ModelsAdmin;
use App\Models\People;
use App\Models\Report;
use App\Models\Response;
use Exception;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * store the request sell
     *id	nama	username	email	nik 	password	jk	no_telp	photo_path	remember_token	created_at	updated_at	
     */
    public function store(Request $request, $id)
    {
        /**
         * Status Code Desc
         * 0 : Menunggu Diproses
         * 1 : Sedang Diproses
         * 2 : Dalam Koordinasi
         * 3 : Selesai
         * 4 : Ditolak
         */

        $rules = [
            'responder' => 'required',
            'text' => 'required',
            'status_code' => 'required'
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $report = Report::findOrFail($id);
        $object = new Response();
        $object->response=$request->text;
        $object->report_id=$id;
        $object->status_code=$request->status_code;
        $object->responder=$request->responder;

        $status_label = "";
        switch ($request->status_code) {
            case '0':
                $status_label = "Menunggu Diproses";
                break;
            case '1':
                $status_label = "Sedang Diproses";
                break;
            case '2':
                $status_label = "Dalam Koordinasi";
                break;
            case '3':
                $status_label = "Selesai";
                break;
            case '4':
                $status_label = "Ditolak";
                break;
            
            default:
                # code...
                break;
        }
        
        $object->status_label=$status_label;

        $report->status_desc=$status_label;
        $report->status=$request->status_code;
        $report->save();

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/report_response/";
            $savePathDB = "/web_files/report_response/$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);
            $object->path = $savePathDB;
        }

        $object->save();


        if ($object) {
            return response()->json([
                'http_response' => 200,
                'status' => 1,
                'message_id' => 'Respon Berhasil Dilaporkan Ke Sistem',
                'message' => 'Respon Berhasil Dilaporkan Ke Sistem',
                'data' => $object,
            ]);
        } else {
            return response()->json([
                'http_response' => 400,
                'status' => 0,
                'message_id' => 'Respon Gagal Dilaporkan Ke Sistem',
                'message' => 'Respon Gagal Dilaporkan Ke Sistem',
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


        $report = Report::where('id_people', '=', $id)->orderBy('created_at', 'desc')
            ->paginate($paginate, ['*'], 'page', $pageNumber);

        if ($id == "all" || $id == null) {
            $report = Report::where('id_people', '<>', 0)->orderBy('created_at', 'desc')
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

    public function delete($id)
    {

        $report = Report::find($id);
        if ($report == null) {
            return response()->json([
                'http_response' => 400,
                'status' => 0,
                'message_id' => 'Gagal Menghapus Report, Report Tidak Ditemukan',
                'message' => 'Gagal Menghapus Report, Report Tidak Ditemukan',
                'report' => $report,
            ], 400);
        } else {

            $file_path = public_path() . $report->photo_path;
            if (file_exists($file_path)) {
                try {
                    unlink($file_path);
                } catch (Exception $e) {
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
            } else {
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
    public function getByID($id)
    {

        $report = Report::find($id);
        if ($report == null) {
            return response()->json([
                'http_response' => 400,
                'status' => 0,
                'message_id' => 'Gagal Menemukan Report',
                'message' => 'Gagal Menemukan Report',
                'report' => $report,
            ], 400);
        } else {
            if ($report) {
                return response()->json([
                    'http_response' => 200,
                    'status' => 1,
                    'message_id' => 'Berhasil Mendapatkan Data Report',
                    'message' => 'Berhasil Mendapatkan Data Report',
                    'report' => $report,
                ], 200);
            } else {
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
