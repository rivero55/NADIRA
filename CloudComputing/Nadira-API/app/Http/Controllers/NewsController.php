<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{

    function viewAdminCreate()
    {
        return view('news.admin_create');
    }
    function viewAdminManage(Request $request)
    {
        $data = News::select('*')
            ->orderBy('created_at', 'ASC');
        if ($request->ajax()) {
            $data = News::select('*')
                ->orderBy('created_at', 'ASC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('img', function ($row) {

                    $img = '  <img class="center-cropped rounded" src="' . $row->cover_link . '" alt="">';

                    return $img;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex"><a href="' . url("/news/$row->id/edit") . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2">Edit/Lihat Detail</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'img'])
                ->make(true);
        }
        return view('news.admin_manage');
    }

    function viewNewsEdit(Request $request, $id)
    {
        $news = News::findOrFail($id);
        return view('news.admin_edit')->with(compact('news'));
    }

    function update(Request $request, $id)
    {

        $rules = [
            "id" => "required",
            "title" => "required",
            "cover_link" => "required",
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $object = News::findOrFail($id);
        $object->title = $request->title;
        $object->author = $request->author;
        $object->cover_link = $request->cover_link;
        $object->content = $request->content;
        $object->further_link = $request->further_link;
        $object->title = $request->title;

        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Mengupdate News Feed"]);
        } else {
            return back()->with(["error" => "Gagal Mengupdate Data News Feed"]);
        }
    }

    function destroy(Request $request, $id)
    {
        $object = News::findOrFail($id);
        $object->delete();

        if ($request->is('api/*')) {
            if ($object) {
                return response()->json([
                    'http_response' => 200,
                    'status' => 1,
                    'message' => 'Berhasil Menghapus Berita',
                    'data' => $object
                ], 200);
            } else {
                return response()->json([
                    'http_response' => 400,
                    'status' => 1,
                    'message' => 'Gagal Menghapus Berita',
                    'data' => $object
                ], 400);
            }
        }

    }


    function store(Request $request)
    {
        $rules = [
            "title" => "required",
            "author" => "required",
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $object = new News();
        $object->title = $request->title;
        $object->author = $request->author;
        $object->cover_link = $request->cover_link;
        $object->content = $request->content;
        $object->further_link = $request->further_link;
        $object->title = $request->title;

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/news_photo/";
            $savePathDB = url('/') . "/web_files/news_photo/$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);
            $object->cover_link = $savePathDB;
        }

        $object->save();

        if ($request->is('api/*')) {
            if ($object) {
                return response()->json([
                    'http_response' => 200,
                    'status' => 1,
                    'message' => 'Berhasil Menyimpan Berita',
                    'data' => $object
                ], 200);
            } else {
                return response()->json([
                    'http_response' => 400,
                    'status' => 1,
                    'message' => 'Gagal Menyimpan Berita',
                    'data' => $object
                ], 400);
            }
        }

        if ($object) {
            return back()->with(["success" => "Berhasil Mengupdate News Feed"]);
        } else {
            return back()->with(["error" => "Gagal Mengupdate Data News Feed"]);
        }

       
    }


    public function fetchAll()
    {
        $news = News::all();
        $newsCount = $news->count();
        return response()->json([
            'http_response' => 200,
            'status' => 1,
            'size' => $newsCount,
            'news' => $news,
            'message_id' => 'Berhasil Fetch Berita',
            'message' => '',
        ]);
    }
}
