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

Route::get('/', function () {
    return view('initial');
});

Route::get('login', array('uses' => 'HomeController@showLogin'));
Route::post('login', array('uses' => 'HomeController@doLogin'));

Route::get('register', array('uses' => 'HomeController@showRegister'));
Route::post('register', array('uses' => 'HomeController@doRegister'));

Route::get('home', function () {
    return view('home');
});

Route::get('users', array('uses' => 'UsersController@showUsers'));

Route::get('roles', array('uses' => 'RolesController@showRoles'));

Route::get('roles/add', array('uses' => 'RolesController@showAddRole'));
Route::post('roles/add', array('uses' => 'RolesController@addRole'));

Route::get('users/{id}/edit', array('uses' => 'UsersController@showEditUser'));
Route::post('users/{id}/edit', array('uses' => 'UsersController@editUser'));

Route::get('skype', array('uses' => 'SkypeController@showAccounts'));
Route::get('skype/{id}/conversions', array('uses' => 'SkypeController@showConversations'));
Route::get('skype/{accountId}/conversions/{conversationId}', array('uses' => 'SkypeController@showMessages'));


Route::get('logout', array('uses' => 'UsersController@logout'));
