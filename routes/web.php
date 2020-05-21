<?php

Route::get('/', 'TestController@test');
Route::get('test', 'TestController@test');

Route::post('login', 'Sys\LoginController@validateLogin');
Route::get('loginCheck', 'Sys\LoginController@checkLogin');
Route::get('logout', 'Sys\LoginController@logout');

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
    Route::resource('purchaseAgreement', 'Moe\PurchaseAgreementController');
    Route::resource('project', 'Moe\ProjectController');
    Route::resource('projectDeveloper', 'Moe\ProjectDeveloperController');
    Route::resource('projectDistrict', 'Moe\ProjectDistrictController');
    Route::resource('projectLicense', 'Moe\ProjectLicenseController');
    Route::resource('projectStation', 'Moe\ProjectStationController');

    Route::resource('river', 'Moe\RiverController');
    Route::resource('station', 'Moe\StationController');
    Route::resource('userTraining', 'Moe\UserTrainingController');
    Route::resource('userEmployment', 'Moe\UserEmploymentController');
    Route::resource('userEducation', 'Moe\UserEducationController');

    Route::resource('workActivity', 'Moe\WorkActivityController');
    Route::resource('costHead', 'Moe\CostHeadController');
    Route::resource('projectSchedule', 'Moe\ProjectScheduleController');
    Route::resource('projectScheduleDependency', 'Moe\ProjectScheduleDependencyController');
    Route::resource('projectCost', 'Moe\ProjectCostController');

    Route::resource('reason', 'Moe\ReasonDefinitionController');
    Route::resource('reasonMapping', 'Moe\ReasonMappingController');

    Route::resource('projectActivityNode', 'Moe\ProjectActivityNodeController');
    Route::resource('activityNodeLink', 'Moe\ActivityNodeLinkController');
    Route::resource('projectPath', 'Moe\ProjectPathController');
    Route::resource('pathRoute', 'Moe\PathRouteController');
    Route::post('calculateCriticalPath', 'Moe\ProjectController@calculateCriticalPath');
    Route::post('calculateSuggestedTimeline', 'Moe\ProjectController@calculateSuggestedTimeline');

    Route::post('analyzeSlope', 'Moe\WorkActivityController@analyzeSlope');
    Route::post('analyseCostOverRun', 'Moe\CostHeadController@analyzeSlope');

    Route::resource('pdaTask', 'Moe\PDATaskController');
    Route::resource('projectPDATask', 'Moe\ProjectPDATaskController');


});

Route::group(['prefix' => 'api/record'], function () {

    Route::get('userPreference', 'Sys\UserPreferenceController@getUserPreference');
    Route::post('userPreference', 'Sys\UserPreferenceController@setUserPreference');
    Route::resource('openProperty', 'Sys\OpenPropertyController');
});


