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

//Route::get('/', function () {
//    return view('welcome');
//});

// Eto yung landing page
Route::get('/', function(){
    return view('landing');
});

Route::get('/test', function(){
    $data = array(
        'title' => "EKSBI"
    );
    return view('pages/test')->with($data);
});

//Route::get('/linkifier', 'LinkifierController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/api_key', 'APIKeyController@index')->name('api_key');
Route::get('/account', 'AccountController@index')->name('account');

Route::post('/linkify', 'LinkifierController@linkify');
Route::get('/linkify', 'LinkifierController@linkify');

Route::post('/linkifier/result', 'LinkifierController@linkifyRes');
Route::get('/linkifier/result', 'LinkifierController@linkifyRes');

Route::resource('linkifier', 'LinkifierController');


// API KEY CRUD ROUTES
Route::get('/api_key/gen_api_key', 'APIKeyController@gen_api_key')->name('gen_api_key');
Route::post('/api_key/create_api_key', 'APIKeyController@create_api_key')->name('create_api_key');
Route::get('/api_key/show_api_keys', 'APIKeyController@show_api_keys')->name('show_api_keys');
Route::post('/api_key/get_api_key', 'APIKeyController@get_api_key')->name('get_api_key');
Route::post('/api_key/update_api_key', 'APIKeyController@update_api_key')->name('update_api_key');
Route::post('/api_key/delete_api_key', 'APIKeyController@delete_api_key')->name('delete_api_key');

// SAMUEL CORE VALIDATIONS ROUTES
Route::get('/validate_key', 'ValidateKey@index');

//ROUTES TO DO
//ABOUT PAGE "/about"
//DOCUMENTATION PAGE "/documentation"
//DEMO PAGE "/demo"
//YUNG 1 link shit

//REVAMPINGS TO DO
//LANDING PAGE "/"
//LOGIN PAGE "/login"
//REGISTER PAGE "/register"