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


Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('backend.dashboard');
    })->name('dashboard');

    Route::get('/buscaGrupos', 'backend\TraduccionController@getGrupos')->name('buscaGrupos');
    Route::resource('traduccion', 'backend\TraduccionController');

    Route::post('/get-trad', 'backend\TraduccionController@getTradToModal')->name('getTrad');

    Route::resource('categoria-faq', 'backend\CategoriaFaqController');
});