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

Route::apiResource('/authors','API\AuthorController');

// Route::group(['prefix'=>'authors/'],function(){
// 	Route::apiResource('{author}/blogs','API\BlogController');
// });

Route::prefix('/authors')->group(function () {
    Route::apiResource('{author}/blogs','API\BlogController');
});

