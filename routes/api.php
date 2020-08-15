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


Route::get('/hello', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/register', 'api\auth\RegisterController@register');
Route::post('/login', 'api\auth\SignInController@signIn');

Route::middleware('auth_token')->group(function () {
    Route::apiResource('posts', 'PostController');
    Route::apiResource('follow', 'FollowerController');
    Route::apiResource('timeline', 'TimeLineController');

    Route::post('/logout', 'AuthController@logout');
    Route::get('/search', 'SearchController@getPeoples');
    Route::get('/get_perfil', 'SearchController@getPerfil');
    Route::get('/posts_by_username', 'PostController@getPostsByUsername');
    Route::post('/edit_perfil', 'EditPerfilController@editPerfil');
});
