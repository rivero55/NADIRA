<?php

use Illuminate\Support\Facades\Route;

Route::get('/santri/mutabaah/export/daily', 'SantriController@laporanExcel')->name('santri.mutabaah.export.daily');
Route::get('/santri/mutabaah/export/all', 'SantriController@laporanExcelAll')->name('santri.mutabaah.export.all');



Route::post('/santri/update_password', 'SantriController@santriChangePassword');

Route::middleware(['santri'])->group(function () {

Route::prefix('santri')->group(function () {
    // Route::get('/','HomeSantriController@index');
    Route::get('/','Mp3StreamingController@viewSantriPreview');


    Route::view('/data/santri/import','admin.santri.import');
    Route::get('/profile','SantriController@santriViewProfile');

    Route::any('/mp3','Mp3StreamingController@viewSantriPreview');

    Route::get('/mutabaah/input','SantriMutabaahController@viewSantriInit');
    Route::get('/mutabaah/report','SantriMutabaahController@viewSantriReport');
    Route::get('/mutabaah/report/all','SantriMutabaahController@viewSantriReportAll')->name('santri.mutabaah.see_report_all');;
    
    Route::get('/mutabaah/{id}/input/','SantriMutabaahController@input')->name('santri.mutabaah.input');
    Route::post('/mutabaah/{id}/input/','SantriMutabaahController@store')->name('santri.mutabaah.store');
    Route::get('/mutabaah/{id}/report/','SantriMutabaahController@viewMutabaahReport')->name('santri.mutabaah.see_report');
    
    Route::any('/data/mutabaah/manage','MutabaahController@viewAdminManage');
    Route::any('/data/mutabaah/preview','MutabaahController@viewAdminPreview');
    Route::any('/data/santri/manage','SantriController@viewAdminManage');
    Route::any('/data/santri/{id}/edit','SantriController@viewAdminEdit');


});

});


?>
