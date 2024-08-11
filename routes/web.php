<?php

use Illuminate\Support\Facades\Route;



///////////////////////////////////// Auth Routes //////////////////////////////////////
Route::get('/', ['uses' =>'App\Http\Controllers\AuthController@index','as' => 'index']);
Route::get('/registration', ['uses' =>'App\Http\Controllers\AuthController@registration','as' => 'registration']);
Route::post('/store-user', ['uses' =>'App\Http\Controllers\AuthController@store','as' => 'storeuser']);
Route::post('/authenticate-user', ['uses' =>'App\Http\Controllers\AuthController@autenticateUser','as' => 'autenticateuser']);
Route::get('/logout-user', ['uses' =>'App\Http\Controllers\AuthController@logoutUser','as' => 'logoutuser']);
Route::get('/login', ['uses' =>'App\Http\Controllers\AuthController@index','as' => 'login']);



///////////////////////////////////// Customer Routes //////////////////////////////////////
Route::get('/manage-customer', ['middleware' => ['auth'],'uses' =>'App\Http\Controllers\CustomerController@index','as' => 'managecustomer']);
Route::get('/create-customer', ['middleware' => ['auth'],'uses' =>'App\Http\Controllers\CustomerController@create','as' => 'createcustomer']);
Route::post('/store-customer', ['middleware' => ['auth'],'uses' =>'App\Http\Controllers\CustomerController@store','as' => 'storecustomer']);
Route::get('/edit-customer/{id}', ['middleware' => ['auth'],'uses' =>'App\Http\Controllers\CustomerController@edit','as' => 'editcustomer']);
Route::post('/update-customer/{id}', ['middleware' => ['auth'],'uses' =>'App\Http\Controllers\CustomerController@update','as' => 'updatecustomer']);
Route::get('/delete-customer/{id}', ['middleware' => ['auth'],'uses' =>'App\Http\Controllers\CustomerController@delete','as' => 'deletecustomer']);
