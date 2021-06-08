<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1/', 'middleware' => ['api']], function () {
	//Member Page API
    Route::get('member_list', 'App\Http\Controllers\Api\MemberApiController@member_list');
	Route::post('member_add', 'App\Http\Controllers\Api\MemberApiController@member_add');
	Route::post('member_update', 'App\Http\Controllers\Api\MemberApiController@member_update');

    //Expense Page API
    Route::post('add_expense', 'App\Http\Controllers\Api\ExpenseApiController@add_expense');
    Route::put('update_expense', 'App\Http\Controllers\Api\ExpenseApiController@update_expense');

    //Home Page API
    Route::get('get_all_member_splits', 'App\Http\Controllers\Api\ExpenseApiController@get_all_member_splits');
    Route::get('get_summary/{summary_of?}', 'App\Http\Controllers\Api\ExpenseApiController@get_summary');
});
