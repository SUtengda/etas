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

//Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
Route::group(['prefix' => 'v1'], function(){
    Route::get('/partners','API\PartnerController@getPartners')->middleware('auth:api');
    Route::get('/partner/{id}','API\PartnerController@getPartner');
    Route::delete('/partner/{id}','API\PartnerController@deletePartner');
    Route::post('/partners', 'API\PartnerController@postNewPartner');
    Route::put('/partner/{id}','API\PartnerController@updatePartner');

    Route::get('/clients/{par_id}','API\ClientController@getClients');
    Route::post('/clients', 'API\ClientController@postNewClient');
    Route::delete('/client/{cli_id}', 'API\ClientController@deleteClient');

    Route::get('/vats','API\VATController@getVATs');
    Route::post('/vats', 'API\VATController@updateVats');
    Route::delete('/vat/{vat_id}', 'API\VATController@deleteVat');
});
