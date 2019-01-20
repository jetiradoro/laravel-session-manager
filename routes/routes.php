<?php

Route::group(['namespace' => 'Jetiradoro\SessionManager'], function () {
    Route::get('/admin/session-manager', 'SessionManagerController@index');

    Route::group(['prefix' => 'api'], function () {
        Route::get('/admin/session-manager', 'SessionManagerController@getData');
});
});
