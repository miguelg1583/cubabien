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
    return view('frontend.' . $blade_uri);
})->name('static_page');

Route::post('/lang', 'frontend\LenguajeController@changeLanguaje');

Route::get('/faqs', 'frontend\FaqController@index')->name('faq.index');
Route::get('/faqs/full', 'frontend\FaqController@full')->name('faq.full');
Route::post('/sum/categoria', 'frontend\FaqController@addVisitaCateg')->name('sum_categ');
Route::post('/sum/pregunta_resp', 'frontend\FaqController@addVisitaPreg')->name('sum_preg');

Route::get('/contact', 'frontend\ContactController@index')->name('contact_us.index');
Route::post('/contact', 'frontend\ContactController@store')->name('contact.store');
Route::get('/refresh-captcha', 'frontend\CaptchaController@refresh')->name('captcha.refresh');
Route::get('/travel_cuba', 'frontend\TourController@index')->name('travel_cuba.index');
Route::get('/travel_cuba/{id}', 'frontend\TourController@show')->name('travel_cuba.show');
Route::post('/fechas-after-list', 'frontend\TourController@getFechasAfterTodayList')->name('fechasAfter.list');

Route::get('/request', 'frontend\PruebaController@getRequestData');

Route::get('/imagen-generada/{path}/{width}/{height}/{type}', 'ImagenController@getImagenGenerada')->name('buscaGrupos');



Route::prefix('admin')->group(function () {

    Auth::routes();

    Route::middleware(['auth'])->group(function () {

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
        Route::put('/contact/atendido/{id}', 'backend\ContactController@setAtendido')->name('setAtendido');
        Route::get('/contact', 'backend\ContactController@index')->name('contact.index');
        Route::resource('tour', 'backend\TourController');
        Route::post('/get-tour', 'backend\TourController@getDataToModal')->name('getDatosTour');
        Route::put('/tour/activo/{id}', 'backend\TourController@setActivo')->name('setActivo');
        Route::resource('itinerario-tour', 'backend\ItinerarioTourController');
        Route::get('/itinerario-list', 'backend\ItinerarioTourController@index_datatable')->name('itinerario-tour.index_datatable');
        Route::post('/get-itinerario-tour', 'backend\ItinerarioTourController@getDataToModal')->name('getDatosItinerarioTour');
        Route::resource('calendario-tour', 'backend\CalendarioTourController');
        Route::post('/calendario-tour-list', 'backend\CalendarioTourController@getList')->name('calendario-tour.list');
        Route::post('/calendario-tour-fullcalendar', 'backend\CalendarioTourController@getCalendar')->name('calendario-tour.calendar');
        Route::post('/get-calendario', 'backend\CalendarioTourController@showCalendar')->name('calendario-tour.getCalendar');
        Route::get('/calendario-list', 'backend\CalendarioTourController@index_datatable')->name('calendario-tour.index_datatable');
        Route::resource('mapa-tour', 'backend\MapaTourController');

        Route::get('imagenes/upload', 'backend\ImagenController@index_upload')->name('imagen.upload');
        Route::post('imagenes/store', 'backend\ImagenController@store')->name('imagen.store');
        Route::post('imagenes/destroy', 'backend\ImagenController@destroy')->name('imagen.destroy');
        Route::post('imagenes/encode', 'backend\ImagenController@getcode')->name('imagen.encode');
        Route::get('imagenes/gallery', 'backend\ImagenController@index_gallery')->name('imagen.gallery');
        Route::get('imagenes/pub_home', 'backend\ImagenController@index_pub_home')->name('imagen.pub_home');

        Route::get('/comando/{command}', function ($command) {
            $exitCode = Artisan::call($command, []);
            return $exitCode;
        });
        Route::get('/comando/generaimagen/{imagen}/{width}/{height}/{type}', function ($imagen, $width, $height, $type) {
            $exitCode = Artisan::call('imagenes:generar', ['image'=>$imagen, 'width'=>$width, 'height'=>$height, 'type'=>$type]);
            return $exitCode;
        });


    });
});


//Route::get('/home', 'HomeController@index')->name('home');
