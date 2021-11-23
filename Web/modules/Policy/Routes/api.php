<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (){
    Route::get('/policies' ,'V1\PolicyController@index');
    Route::delete('/policies' ,'V1\PolicyController@delete');
});
