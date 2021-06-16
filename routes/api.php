<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('currency')->group(function () {
    Route::get('/', 'CurrencyController@getAllCurrencies');
    Route::get('/converter', 'CurrencyController@converterCurrency');
    Route::get('/{id}', 'CurrencyController@getCurrencyById');

    Route::patch('/{id}', 'CurrencyController@updateItemsCurrency');
    Route::put('/{id}', 'CurrencyController@updateAllItemsCurrency');
    
    Route::post('/', 'CurrencyController@newCurrency');
});
