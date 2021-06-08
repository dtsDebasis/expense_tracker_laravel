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
    Route::get('member_list', 'App\Http\Controllers\Api\MemberApiController@member_list')->name('member_list_api');
	Route::post('member_add', 'App\Http\Controllers\Api\MemberApiController@member_add')->name('member_add_api');
	Route::post('member_update', 'App\Http\Controllers\Api\MemberApiController@member_update')->name('member_update_api');

    //Expense Page API
    Route::post('add_expense', 'App\Http\Controllers\Api\ExpenseApiController@add_expense')->name('add_expense_api');
    Route::put('update_expense', 'App\Http\Controllers\Api\ExpenseApiController@update_expense')->name('update_expense_api');

    //Home Page API
    Route::get('get_all_member_splits', 'App\Http\Controllers\Api\ExpenseApiController@get_all_member_splits')->name('get_all_member_splits_api');
    Route::get('get_summary/{summary_of?}', 'App\Http\Controllers\Api\ExpenseApiController@get_summary')->name('get_summary_api');
});
