<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
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
    return view('welcome');
});

//resource routes for user and company
Route::resource('user', UserController::class);
Route::resource('company', CompanyController::class);
//add users to company
Route::get('company/users/{id}', [CompanyController::class,'comapnyUsers']);
Route::post('company/add/users', [CompanyController::class,'addUsers']);