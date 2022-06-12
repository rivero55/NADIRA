<?php

namespace App\Http\Controllers;


class HomeAdminController extends Controller
{
    public function index(){

        $widget= [
        ];
        return view('admin.dashboard.home')->with(compact('widget'));
    }
}
