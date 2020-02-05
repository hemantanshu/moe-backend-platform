<?php

Route::group(['namespace' => 'Drivezy\LaravelAdmin\Controllers',
              'prefix'    => 'api/record'], function () {

    Route::resource('module', 'ModuleController');
    Route::resource('menu', 'MenuController');
    Route::resource('moduleMenu', 'ModuleMenuController');
    Route::resource('parentMenu', 'ParentMenuController');
    Route::resource('page', 'PageDefinitionController');

    Route::get('menuDetails/{id}', 'MenuController@getMenuDetails');
    Route::get('menus', 'MenuController@getMenus');

    Route::resource('clientScript', 'ClientScriptController');
    Route::resource('uiAction', 'UIActionController');

    Route::resource('customForm', 'CustomFormController');
    Route::get('formDetails/{id}', 'CustomFormController@getFormDetails');
});