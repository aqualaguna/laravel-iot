<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware'=>'auth:api'],function(){
	Route::get('/user',function (Request $request) {
		return $request->user();
	});
	Route::post('subcribe','UserController@update');
	Route::get('/device','DeviceController@getByUser'); //avaible api
	Route::post('/device','DeviceController@add');//avaible api
	Route::put('/device','DeviceController@update');
	Route::delete('/device','DeviceController@delete');
	Route::post('/sendcmd','DeviceController@sendcmd');

	Route::post('graph','GraphController@add');
	Route::delete('graph','GraphController@delete');
	Route::get('graph','GraphController@getByUser');

});


