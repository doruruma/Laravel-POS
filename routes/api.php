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

// Categories
Route::get('/categories/{category}', 'CategoryController@get');

// Products
Route::get('/products/{product}', 'ProductController@get');

// Users
Route::get('/users/{user}', 'UserController@get');

// Customers
Route::get('/customers/{customer}', 'CustomerController@get');

// Roles
Route::get('/roles/{role}', 'RoleController@get');

// Access
Route::get('/access/{access}', 'AccessController@get');

