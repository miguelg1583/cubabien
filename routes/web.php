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

Route::get('/', 'frontend\HomeController@index')->name('home');

Route::get('/static/{blade_uri}', function ($blade_uri) {
    return view('frontend.'.$blade_uri);
})->name('static_page');

Route::post('/lang', 'frontend\LenguajeController@changeLanguaje');

Route::get('/faqs', 'frontend\FaqController@index')->name('faq.index');
Route::get('/faqs/full', 'frontend\FaqController@full')->name('faq.full');
Route::post('/sum/categoria', 'frontend\FaqController@addVisitaCateg')->name('sum_categ');
Route::post('/sum/pregunta_resp', 'frontend\FaqController@addVisitaPreg')->name('sum_preg');

Route::get('/contact','frontend\ContactController@index')->name('contact_us.index');
Route::post('/contact','frontend\ContactController@store')->name('contact.store');
Route::get('/refresh-captcha', 'frontend\CaptchaController@refresh')->name('captcha.refresh');
Route::get('/travel_cuba', 'frontend\TourController@index')->name('travel_cuba.index');
Route::get('/travel_cuba/{id}', 'frontend\TourController@show')->name('travel_cuba.show');
Route::post('/fechas-after-list', 'frontend\TourController@getFechasAfterTodayList')->name('fechasAfter.list');




Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('backend.dashboard');
    })->name('dashboard');

    Route::get('/buscaGrupos', 'backend\TraduccionController@getGrupos')->name('buscaGrupos');
    Route::post('/get-trad', 'backend\TraduccionController@getTradToModal')->name('getTrad');
    Route::resource('traduccion', 'backend\TraduccionController');

//    Route::get('/server/traduccion', 'backend\TraduccionController@index2')->name('trad.index');
    Route::post('/server/traduccionlist', 'backend\TraduccionController@getList2')->name('trad.list');

    Route::resource('categoria-faq', 'backend\CategoriaFaqController');
    Route::post('/get-preg-resp', 'backend\PreguntaRespController@getDataToModal')->name('getDatosPregResp');
    Route::resource('pregunta-resp', 'backend\PreguntaRespController');
    Route::post('/contactlist', 'backend\ContactController@getList')->name('contact.list');
    Route::get('/contact', 'backend\ContactController@index')->name('contact.index');
    Route::resource('tour', 'backend\TourController');
    Route::post('/get-tour', 'backend\TourController@getDataToModal')->name('getDatosTour');
    Route::put('/tour/activo/{id}', 'backend\TourController@setActivo')->name('setActivo');
    Route::resource('itinerario-tour', 'backend\ItinerarioTourController');
    Route::post('/get-itinerario-tour', 'backend\ItinerarioTourController@getDataToModal')->name('getDatosItinerarioTour');
    Route::resource('calendario-tour', 'backend\CalendarioTourController');
    Route::post('/calendario-tour-list', 'backend\CalendarioTourController@getList')->name('calendario-tour.list');



});