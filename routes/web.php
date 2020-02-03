<?php

Route::get('/', 'TestController@test');
Route::get('test', 'TestController@test');

Route::resource('country', 'Moe\CountryController');
Route::post('login', 'Sys\LoginController@validateLogin');
Route::get('loginCheck', 'Sys\LoginController@checkLogin');

Route::group(['prefix' => 'api/admin'], function () {

    Route::get('userPreference', 'Sys\UserPreferenceController@getUserPreference');
    Route::post('userPreference', 'Sys\UserPreferenceController@setUserPreference');
    Route::resource('openProperty', 'Sys\OpenPropertyController');
});
