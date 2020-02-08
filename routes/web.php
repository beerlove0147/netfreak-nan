<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/test-video', function () {
    return view('partials.vimeo-video-player');
});

//แสดงรายการ ซีรีย์/ตอน index
route::get('/series', function () {
    $series =\App\Serie::all();
    return view('serie.index')->with([
        'series' => $series
        ]);

})->name('series');

//แสดงฟอร์มสร้าง ซีรีย์/ตอน
route::get('/series/create', function () {
    return view('serie.create');
});

route::get('/series/{serieId}/episodes/create', function ($serieId) {
    return view('episode.create')->with(['serieId' =>$serieId]);
});

//รับข้อมูลจากฟอร์มสร้าง ซีรีย์/ตอน แล้วบันทึกลงตาราง
route::post('/series/{id}/episodes', function ($id) {
    $data= \Request::all();

    $episode = \App\Episode::create($data);

    $episode->serie_id = $id;

    $episode->save();

    return redirect('/series/'.$id);
});

//แสดง ตอน ที่มีอยู่ในซีรีย์
// route::get('/series/{id}',function($id) {
//     $serie = \App\Serie::find($id);

//     return view('serie.show')->with([
//         'serie'=> $serie
//     ]);
// });

route::get('/series/{serie}',function(\App\Serie $serie) {
    // $serie = \App\Serie::find($id);

    return view('serie.show')->with([
        'serie'=> $serie
    ]);
});


