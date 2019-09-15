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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth', 'as' => 'auth:'], function() {
	Route::post('register', ['uses' => 'RegisterController', 'as' => 'register']);
	Route::post('/login', ['uses' => 'LoginController', 'as' => 'login']);

	Route::get('/me', ['uses' => 'ProfileController@me', 'as' => 'me']);

	Route::get('/social/redirect', ['uses' => 'SocialiteController@redirectToProvider', 'as' => 'social:redirect']);
	Route::get('/social/callback', ['uses' => 'SocialiteController@handleProviderCallback', 'as' => 'social:callback']);
});

Route::group(['prefix' => 'farmer', 'middleware' => ['auth:api']], function() {
	Route::group(['prefix' => 'tree'], function() {
		Route::post('/new', 'DurianTreeController@create');
		Route::get('/', 'DurianTreeController@all');

		Route::get('/{id}/manage', 'DurianTreeController@show');
		Route::post('/{id}/manage', 'DurianTreeController@update');
	});
});

Route::get('/monitoring', 'MonitoringController@create');
Route::get('/records/{id}', 'MonitoringController@records');

Broadcast::routes(['middleware' => ['auth:api']]);