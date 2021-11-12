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

Route::post('login', 'LoginController@login');
Route::post('register', 'LoginController@register');


//Route::get('role-list','RoleController@getListOfRoles');
//Route::post('create-role','RoleController@createRole');
//Route::post('delete-role','RoleController@deleteRole');
//
//Route::post('assign-role','RoleController@assignRole');
//Route::post('delete-assign-role','RoleController@deleteAssignedRole');
//
//
//Route::get('user-profile/{id}', 'UserController@userProfileInformation');
//Route::get('user-list', 'UserController@userList');








//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::group([ 'middleware' => ['auth:api','checkAdmin']], function () {

//    Route::get('/user','LoginController@details'); //return auth user details

    Route::get('role-list','RoleController@getListOfRoles');
    Route::post('create-role','RoleController@createRole');
    Route::post('delete-role','RoleController@deleteRole');

    Route::post('assign-role','RoleController@assignRole');
    Route::post('delete-assign-role','RoleController@deleteAssignedRole');


    Route::get('user-profile/{id}', 'UserController@userProfileInformation');
    Route::get('user-list', 'UserController@userList');

    Route::post('logout', 'LoginController@logout');




});
