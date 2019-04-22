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

Route::get('/transaksi', 'TransaksiController@index');

Route::post('/transaksi/store', 'TransaksiController@store');

Route::get('/transaksi/history/{days}', 'TransaksiController@showTotalTransaksi');

Route::get('/transaksi/{id}', 'TransaksiController@show');

Route::get('/transaksi/search/{nama_barang}', 'TransaksiController@searchTransaksi');

Route::post('/transaksi/update/{id}', 'TransaksiController@update');

Route::delete('/transaksi/delete/{id}', 'TransaksiController@destroy');

Route::post('/register', 'UserController@register');

Route::post('/login', 'UserController@login');


