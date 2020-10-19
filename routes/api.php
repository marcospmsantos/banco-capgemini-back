<?php

use Illuminate\Http\Request;
use \App\Models\User;

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

Route::middleware('auth:api')->get('/auth', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {

    /**
     * Auth / Me
     */
    Route::get('/me', 'AuthController@me');

    /**
     * Conta
     */
    Route::get('saldo', 'API\ContaController@saldo');

    /**
     * Transacao
     */
    Route::post('transacao/saque', 'API\TransacaoController@saque');
    Route::post('transacao/deposito', 'API\TransacaoController@deposito');
    Route::put('transacao/confirmacao/{id}', 'API\TransacaoController@confirmacao');
    Route::patch('transacao/cancelar/{id}', 'API\TransacaoController@cancelar');
});
