<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
/*
Route::get('/login', function () {
    return view('login/login');
});
*/

Route::get('/bazaar/', 'CharactersaleController@index');
Route::get('/bazaar/{pid}', 'CharactersaleController@bidpost');
Route::get('/getsalespage/{pid}', 'Eveapi\EveapiController@index');
Route::get('/getsalesposts/', 'Eveapi\EveapiController@posts');
Route::get('/login/', 'Auth\AuthController@index');
Route::post('/login/', 'Auth\AuthController@index');
Route::get('/login/out', 'Auth\AuthController@out');
Route::get('/login/complete','Auth\AuthController@complete'/*, [ 'middleware' => 'auth', 'uses' => 'Auth\AuthController@complete']*/);
Route::post('/login/complete', 'Auth\AuthController@complete'/*, [ 'middleware' => 'auth', 'uses' => 'Auth\AuthController@complete']*/);
Route::get('/login/fbcallback', 'Auth\AuthController@fbcallback');
Route::get('/login/vkcallback', 'Auth\AuthController@vkcallback');
Route::get('/eveboard/{charname}', 'Eveapi\EveboardController@index');
Route::get('/myprofile/', 'ProfileController@index');
Route::get('/apikeys/', 'ProfileController@apikeys');
Route::get('/mycharacters/', 'ProfileController@characters');
Route::post('/addkeys/', 'ProfileController@addkeys');
Route::get('/jackapi/', 'Eveapi\JackapiController@skills');
Route::post('/sellnow/', 'CharactersaleController@sellNow');
Route::post('/bidnow/', 'CharactersaleController@bidNow');