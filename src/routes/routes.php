<?php
//if(config('config.default_routes')) {


    Route::group(['namespace' => 'Jetiradoro\SessionManager'], function () {
        Route::get('/admin/current-connections', 'SessionManagerController@index')->name('tracker.connections')->middleware(['web','auth']);

        Route::group(['prefix' => 'api'], function () {
            Route::get('/admin/current-connections', 'SessionManagerController@connections');
            Route::delete('/admin/current-connections/{session_id}', 'SessionManagerController@destroySession');
        });
    });
//}