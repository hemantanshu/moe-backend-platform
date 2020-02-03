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

    Route::resource('country', 'Moe\CountryController');
    Route::resource('zone', 'Moe\ZoneController');
    Route::resource('district', 'Moe\DistrictController');
    Route::resource('city', 'Moe\CityController');
    Route::resource('developer', 'Moe\DeveloperController');
    Route::resource('developerMember', 'Moe\DeveloperMemberController');
    Route::resource('developmentAgreement', 'Moe\DevelopmentAgreementController');
    Route::resource('project', 'Moe\ProjectController');
    Route::resource('projectDeveloper', 'Moe\ProjectDeveloperController');
    Route::resource('projectDistrict', 'Moe\ProjectDistrictController');
    Route::resource('projectLicense', 'Moe\ProjectLicenseController');
    Route::resource('projectStation', 'Moe\ProjectStationController');

    Route::resource('river', 'Moe\RiverController');
    Route::resource('station', 'Moe\StationController');
    Route::resource('userTraining', 'Moe\UserTrainingController');
});
