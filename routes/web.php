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
    return view('frontend.home');
})->name('home');

Route::get('/static/{blade_uri}', function ($blade_uri) {
    return view('frontend.'.$blade_uri);
})->name('static_page');

Route::post('/lang', 'frontend\LenguajeController@changeLanguaje');

Route::get('/faqs', 'frontend\FaqController@index')->name('faq.index');
Route::get('/faqs/full', 'frontend\FaqController@full')->name('faq.full');
Route::post('/sum/categoria', 'frontend\FaqController@addVisitaCateg')->name('sum_categ');
Route::post('/sum/pregunta_resp', 'frontend\FaqController@addVisitaPreg')->name('sum_preg');





Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('backend.dashboard');
    })->name('dashboard');

    Route::get('/buscaGrupos', 'backend\TraduccionController@getGrupos')->name('buscaGrupos');
    Route::post('/get-trad', 'backend\TraduccionController@getTradToModal')->name('getTrad');
    Route::resource('traduccion', 'backend\TraduccionController');
    Route::resource('categoria-faq', 'backend\CategoriaFaqController');
    Route::post('/get-preg-resp', 'backend\PreguntaRespController@getDataToModal')->name('getDatosPregResp');
    Route::resource('pregunta-resp', 'backend\PreguntaRespController');

});