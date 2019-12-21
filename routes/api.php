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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/hello', function () {
    return helloWorld();
});

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');

Route::middleware('auth_token')->group(function () {
    Route::apiResource('posts', 'PostController');
    Route::apiResource('follow', 'FollowerController');
    Route::apiResource('timeline', 'TimeLineController');

    Route::post('/logout', 'AuthController@logout');
    Route::get('/search', 'SearchController@getPeoples');
    Route::post('/edit_perfil', 'EditPerfilController@editPerfil');
});
