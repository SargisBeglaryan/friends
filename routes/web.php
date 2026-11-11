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

Route::get('/', 'SourceController@index');
Route::post('/createSource', 'SourceController@createSource');
Route::post('/createFriends/{network}', 'SocialNetworkController@createFriends')
    ->whereIn('network', ['facebook', 'instagram']);
Route::post('/checkFriends/{network}', 'SocialNetworkController@showDeletedFriends')
    ->whereIn('network', ['facebook', 'instagram']);