<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (){
    Route::get('/policies' ,'V1\PolicyController@index');
    Route::post('/policies' ,'V1\PolicyController@store');
    Route::get('/policies/{policy}/trash' ,'V1\PolicyController@trash');
    Route::delete('/policies/{policy}' ,'V1\PolicyController@delete');
});
