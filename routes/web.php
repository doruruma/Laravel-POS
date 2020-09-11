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


/**
 * Auth
 */
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', 'AuthController@login')->name('login');
    Route::post('/login', 'AuthController@postLogin')->name('postLogin');
});


/**
 * Logout
 */
Route::post('/logout', 'AuthController@logout')->name('logout');


/**
 * Route Middleware Auth
 */
Route::group(['middleware' => 'auth'], function () {


    // Dashboard
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');


    // Access
    Route::get('/api/access/{access}', 'AccessController@get');


    // Profile
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/edit-profile', 'ProfileController@profile')->name('profile.edit');
    Route::get('/profile/change-password', 'ProfileController@password')->name('profile.password');
    Route::patch('/profile', 'ProfileController@updateProfile')->name('profile.update-profile');
    Route::patch('/profile/password', 'ProfileController@updatePassword')->name('profile.update-password');


    /**
     * Admin Route
     */
    Route::group(['middleware' => 'admin'], function () {

        // Users
        Route::get('/users', 'UserController@index')->name('user');
        Route::post('/users/store', 'UserController@store')->name('user.store');
        Route::post('/users/{user}', 'UserController@update')->name('user.update');
        Route::delete('/users/{user}', 'UserController@delete')->name('user.delete');
        // Users JSON
        Route::get('/api/users/{user}', 'UserController@get');

        // Roles
        Route::get('/roles', 'RoleController@index')->name('role');
        Route::get('/roles/permission/{role}', 'RoleController@permission')->name('role.permission');
        Route::post('/roles/permission/{role}', 'RoleController@updatePermission')->name('role.update-permission');
        Route::post('/roles/store', 'RoleController@store')->name('role.store');
        Route::post('/roles/{role}', 'RoleController@update')->name('role.update');
        Route::delete('/roles/{role}', 'RoleController@delete')->name('role.delete');
        // Roles JSON
        Route::get('/api/roles/{role}', 'RoleController@get');
    });


    /**
     * User Route
     */
    Route::group(['middleware' => 'user'], function () {

        // Categories
        Route::get('/categories', 'CategoryController@index')->name('category');
        Route::post('/categories/store', 'CategoryController@store')->name('category.store');
        Route::post('/categories/{category}', 'CategoryController@update')->name('category.update');
        Route::delete('/categories/{category}', 'CategoryController@delete')->name('category.delete');
        // Categories JSON
        Route::get('/api/categories/{category}', 'CategoryController@get');

        // Suppliers
        Route::get('/suppliers', 'SupplierController@index')->name('supplier');
        Route::post('/suppliers/store', 'SupplierController@store')->name('supplier.store');
        Route::post('/suppliers/{supplier}', 'SupplierController@update')->name('supplier.update');
        Route::delete('/suppliers/{supplier}', 'SupplierController@delete')->name('supplier.delete');
        // Suppliers JSON
        Route::get('/api/suppliers/{supplier}', 'SupplierController@get');

        // Stock Purchase
        Route::get('/purchases', 'PurchaseController@index')->name('purchase');
        Route::get('/purchases/create', 'PurchaseController@create')->name('purchase.create');
        Route::post('/purchases/store', 'PurchaseController@store')->name('purchase.store');
        Route::get('/purchases/detail/{id}', 'PurchaseController@detail')->name('purchase.detail');
        Route::get('/purchases/count-total', 'PurchaseController@countTotal');
        Route::get('/purchases/generate-pdf', 'PurchaseController@generatePdf')->name('purchase.generate-pdf');
        // Stock Purchase JSON
        Route::get('/purchases/get-suppliers', 'PurchaseController@getSuppliers');
        Route::get('/purchases/get-products', 'PurchaseController@getProducts');
        Route::get('/purchases/get-supplier-by-id/{id}', 'PurchaseController@getSupplierById');
        // Stock Purchase View
        Route::get('/purchases/get-table-product', 'PurchaseController@getTableProduct');

        // Products
        Route::get('/products', 'ProductController@index')->name('product');
        Route::get('/products/create', 'ProductController@create')->name('product.create');
        Route::post('/products/store', 'ProductController@store')->name('product.store');
        Route::post('/products/{product}', 'ProductController@update')->name('product.update');
        Route::delete('/products/{product}', 'ProductController@delete')->name('product.delete');
        // Products JSON
        Route::get('/api/products/{product}', 'ProductController@get');
    });


    /**
     * Cashier Route
     */
    Route::group(['middleware' => 'cashier'], function () {

        // Cashier
        Route::get('/cashier', 'CashierController@index')->name('cashier');
        Route::get('/cashier/paginate-product', 'CashierController@paginateProduct');
        Route::get('/cashier/paginate-customer', 'CashierController@paginateCustomer');
        Route::get('/cashier/search-product', 'CashierController@searchProduct')->name('product.search');
        Route::get('/cashier/search-customer', 'CashierController@searchCustomer')->name('customer.search');

        // Cart
        Route::get('/cart', 'CartController@index')->name('cart');
        Route::get('/cart/{product}', 'CartController@store')->name('cart.store');
        Route::get('/cart/add/{cart}', 'CartController@addQty')->name('cart.add-qty');
        Route::get('/cart/min/{cart}', 'CartController@minQty')->name('cart.min-qty');
        Route::delete('/cart/{cart}', 'CartController@delete')->name('cart.delete');
    });
});
