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
    return view('welcome');
});

Route::get('/products', 'Product\ProductController@index')->name('products');
Route::get('/product/{id}', 'Product\ProductController@detail')->name('product');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function()
{
    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::get('/dashboard', 'Admin\AdminController@index')->name('admin.home');
    Route::get('/tabel kategori', 'Category\CategoryController@index')->name('category.index');
    Route::post('/category', 'Category\CategoryController@create')->name('category.create');
    Route::put('/category/{id}', 'Category\CategoryController@update')->name('category.update');
    Route::delete('/category/{id}', 'Category\CategoryController@delete')->name('category.delete');

    Route::get('tabel barang', 'Product\ProductController@indexadmin')->name('product.index');
    Route::get('/tambah barang', 'Product\ProductController@new')->name('product.new');
    Route::post('/product', 'Product\ProductController@create')->name('product.create');
    Route::get('/edit barang/{id}', 'Product\ProductController@edit')->name('product.edit');
    Route::post('/product update/{id}', 'Product\ProductController@update')->name('product.update');
    Route::delete('/product/{id}', 'Product\ProductController@delete')->name('product.delete');

    Route::get('edit barang', function(){
        return view('views_admin.barang_edit');
    });

    Route::get('tabel pesanan', function(){
        return view('views_admin.pesanan_tabel');
    });

    Route::get('tabel pelanggan', function(){
        return view('views_admin.pelanggan_tabel');
    });

    Route::get('tabel penjualan', function(){
        return view('views_admin.penjualan_tabel');
    });

    Route::get('tabel penilaian', function(){
        return view('views_admin.penilaian_tabel');
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/carts', 'Cart\CartController@index')->name('carts');
    Route::post('/cart', 'Cart\CartController@create')->name('cart.create');
    Route::put('/cart', 'Cart\CartController@update')->name('cart.update');
    Route::delete('/cart/{id}', 'Cart\CartController@delete')->name('cart.delete');

    Route::get('/checkout', 'Order\OrderController@index')->name('order');

    Route::post('/address', 'Address\AddressController@create')->name('address.create');
    Route::put('/address/{id}', 'Address\AddressController@update')->name('address.update');
    Route::delete('/address{id}', 'Address\AddressController@delete')->name('address.delete');

    Route::get('/pembayaran', 'Order\OrderController@pembayaran')->name('pembayaran');
    Route::post('/buy now', 'Cart\CartController@buyNow')->name('cart.buyNow');
    Route::get('/transaction', 'Transaction\TransactionController@index')->name('transaction');
});

Route::get('/belanjaanku', 'Belanjaan\BelanjaanController@index')->name('belanjaanku');

// ===============================ROUTE ADMIN====================================


// Route::prefix('admin')->group(function(){
//     Route::get('tabel pesanan', function(){
//         return view('views_admin.pesanan_tabel');
//     });

//     Route::get('tabel pelanggan', function(){
//         return view('views_admin.pelanggan_tabel');
//     });

//     Route::get('tabel penjualan', function(){
//         return view('views_admin.penjualan_tabel');
//     });

//     Route::get('tabel penilaian', function(){
//         return view('views_admin.penilaian_tabel');
//     });

//     // Route::get('/tabel kategori', 'Category\CategoryController@index')->name('category.index');
//     // Route::post('/category', 'Category\CategoryController@create')->name('category.create');
//     // Route::put('/category/{id}', 'Category\CategoryController@update')->name('category.update');
//     // Route::delete('/category/{id}', 'Category\CategoryController@delete')->name('category.delete');

//     Route::get('tabel barang', 'Product\ProductController@indexadmin')->name('product.index');
//     Route::get('/tambah barang', 'Product\ProductController@new')->name('product.new');
//     Route::post('/product', 'Product\ProductController@create')->name('product.create');
//     Route::delete('/product/{id}', 'Product\ProductController@delete')->name('product.delete');

//     Route::get('edit barang', function(){
//         return view('views_admin.barang_edit');
//     });

// });