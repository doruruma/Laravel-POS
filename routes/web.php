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

// Auth
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', 'AuthController@login')->name('login');
    Route::post('/login', 'AuthController@postLogin')->name('postLogin');
});

// Logout
Route::post('/logout', 'AuthController@logout')->name('logout');

// Route Middleware Auth
Route::group(['middleware' => 'auth'], function () {
    
    // Dashboard
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');    

    // Profile
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/edit-profile', 'ProfileController@profile')->name('profile.edit');
    Route::get('/profile/change-password', 'ProfileController@password')->name('profile.password');
    Route::patch('/profile', 'ProfileController@updateProfile')->name('profile.update-profile');
    Route::patch('/profile/password', 'ProfileController@updatePassword')->name('profile.update-password');

    Route::group(['middleware' => 'admin'], function () {
        // Users
        Route::get('/users', 'UserController@index')->name('user');
        Route::post('/users/store', 'UserController@store')->name('user.store');
        Route::post('/users/{user}', 'UserController@update')->name('user.update');
        Route::delete('/users/{user}', 'UserController@delete')->name('user.delete');

        // Roles
        Route::get('/roles', 'RoleController@index')->name('role');
        Route::get('/roles/permission/{role}', 'RoleController@permission')->name('role.permission');
        Route::post('/roles/permission/{role}', 'RoleController@updatePermission')->name('role.update-permission');
        Route::post('/roles/store', 'RoleController@store')->name('role.store');
        Route::post('/roles/{role}', 'RoleController@update')->name('role.update');
        Route::delete('/roles/{role}', 'RoleController@delete')->name('role.delete');
    });

    Route::group(['middleware' => 'user'], function () {
        // Categories
        Route::get('/categories', 'CategoryController@index')->name('category');
        Route::post('/categories/store', 'CategoryController@store')->name('category.store');
        Route::post('/categories/{category}', 'CategoryController@update')->name('category.update');
        Route::delete('/categories/{category}', 'CategoryController@delete')->name('category.delete');
    
        // Products
        Route::get('/products', 'ProductController@index')->name('product');
        Route::get('/products/create', 'ProductController@create')->name('product.create');
        Route::post('/products/store', 'ProductController@store')->name('product.store');
        Route::post('/products/{product}', 'ProductController@update')->name('product.update');
        Route::delete('/products/{product}', 'ProductController@delete')->name('product.delete');
    });

    Route::group(['middleware' => 'cashier'], function () {
        // Cashier
        Route::get('/cashier', 'CashierController@index')->name('cashier');
        Route::get('/cashier/paginate-product', 'CashierController@paginateProduct');
        Route::get('/cashier/paginate-customer', 'CashierController@paginateCustomer');
        Route::get('/cashier/search-product', 'CashierController@searchProduct')->name('product.search');
        Route::get('/cashier/search-customer', 'CashierController@searchCustomer')->name('customer.search');

        // Customers
        Route::get('/customers', 'CustomerController@index')->name('customer');
        Route::post('/customers/store', 'CustomerController@store')->name('customer.store');
        Route::post('/customers/{customer}', 'CustomerController@update')->name('customer.update');
        Route::delete('/customers/{customer}', 'CustomerController@delete')->name('customer.delete');

        // Cart
        Route::get('/cart', 'CartController@index')->name('cart');
        Route::get('/cart/{product}', 'CartController@store')->name('cart.store');
        Route::get('/cart/add/{cart}', 'CartController@addQty')->name('cart.add-qty');
        Route::get('/cart/min/{cart}', 'CartController@minQty')->name('cart.min-qty');
        Route::delete('/cart/{cart}', 'CartController@delete')->name('cart.delete');
    });
    
});
