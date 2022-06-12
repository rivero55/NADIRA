<?php

use Illuminate\Support\Facades\Route;


Route::post('/group/store','AdminGroupController@store');
Route::post('/group/change_mentor','AdminGroupController@changeMentor');
Route::post('/group/delete','AdminGroupController@delete');

Route::post('/guru/adminInsert','GuruController@adminInsert');
Route::delete('/guru/{id}/adminDelete','GuruController@deleteAjax');

Route::get('/group/{id}/detail','GroupController@viewDetail');

Route::get('/news/{id}/edit','NewsController@viewNewsEdit');
Route::post('/news/{id}/edit','NewsController@update');
Route::post('/news/store','NewsController@store');
Route::delete('/news/{id}/delete','NewsController@destroy');
Route::get('/news/create','NewsController@viewAdminCreate');

Route::get("/report_category/manage",'ReportCategoryController@viewManage');
Route::post("/report_category/manage",'ReportCategoryController@viewManage');
Route::get("/report_category/create",'ReportCategoryController@viewCreate');

Route::get('/report_category/{id}/edit','ReportCategoryController@viewUpdate');
Route::post('/report_category/{id}/edit','ReportCategoryController@update');
Route::delete('/report_category/{id}/delete','ReportCategoryController@destroy');
Route::post("/report_category/store",'ReportCategoryController@store');


Route::group(['prefix' => 'post', 'middleware' => ['auth']], function(){
    Route::get('all','Controller@post');
    Route::get('user','Controller@post');    
});


?>
