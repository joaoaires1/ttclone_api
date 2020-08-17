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

Route::middleware('auth:api')->group(function () {
    Route::post('/follow', 'api\follow\FollowController@store');
    Route::delete('/unfollow', 'api\follow\UnfollowController@destroy');

    Route::get('/posts', 'api\posts\GetPostsController@index');
    Route::post('/posts', 'api\posts\StorePostController@store');
    Route::delete('/posts', 'api\posts\DeletePostController@destroy');

    Route::get('/search', 'SearchController@getPeoples');
    Route::post('/edit_perfil', 'EditPerfilController@editPerfil');
});
