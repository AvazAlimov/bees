<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
Route::get('setlocale/{locale}', function ($locale) {
    in_array($locale, \Config::get('app.locales'));
    return redirect()->back()->withCookie(cookie()->forever('language', $locale));
})->name('lang.switch');



Route::prefix('admin')->group(function (){
    Route::any('get/user/{id?}', 'Admin\AdminAjaxController@getUsers')->name('getUsers');
    Route::get('nomma-nom','Admin\AdminController@nomma')->name('nomma');
    Route::any('get/nomma-nom','Admin\AdminAjaxController@getNomma')->name('getNomma');
    Route::post('nomma-nom/submit','Admin\AdminController@submitNomma')->name('submit.nomma');
    Route::get('nomma-nom/delete/{id}','Admin\AdminController@deleteNomma')->name('delete.nomma');
    Route::post('nomma-nom/update/{id}','Admin\AdminController@updateNomma')->name('update.nomma');
    Route::get('nomma-nom/export', 'Admin\AdminExcelController@exportNomma')->name('export.nomma');
    Route::get('ishlabchiqarish','Admin\AdminController@ishlab')->name('ishlabchiqarish');
    Route::get('svod','Admin\AdminController@swot')->name('swot');
    Route::any('get/swot/{id?}','Admin\AdminAjaxController@getSwot')->name('getSwot');
    Route::any('get/regions','Admin\AdminAjaxController@getRegion')->name('getRegion');
    Route::get('region/excel','Admin\AdminExcelController@regionExport')->name('region.export');
    Route::get('excel/{id?}','Admin\AdminExcelController@swotExport')->name('swot.export');
    Route::get('user/excel/{id?}', 'Admin\AdminExcelController@usersExport')->name('user.export');

    Route::any('get/ishlabchiqarish','Admin\AdminAjaxController@ishlabchiqarish')->name('ishlabchiqarish.data');
    Route::get('ishlabchiqarish/delete/{id}','Admin\AdminController@deleteIshlabchiqarish')->name('delete.ishlabchiqarish');
    Route::post('ishlabchiqarish/update/{id}','Admin\AdminController@updateIshlabchiqarish')->name('update.ishlabchiqarish');
    Route::get('ishlabchiqarish/excel','Admin\AdminExcelController@ishlabchiqarishExport')->name('ishlabchiqarish.export');
    Route::prefix('requisition')->group(function () {
        Route::get('productions', 'Admin\AdminRequisitionController@productions')->name('requisition.production');
        Route::any('productions/ajax', 'Admin\AdminRequisitionAjaxController@productions')->name('requisition.production.ajax');

        Route::get('exports', 'Admin\AdminRequisitionController@exports')->name('requisition.export');
        Route::any('exports/ajax', 'Admin\AdminRequisitionAjaxController@exports')->name('requisition.export.ajax');

        Route::get('realizations', 'Admin\AdminRequisitionController@realizations')->name('requisition.realization');
        Route::any('realizations/ajax', 'Admin\AdminRequisitionAjaxController@realizations')->name('requisition.realization.ajax');

        Route::get('productions/accept/{id}', 'Admin\AdminRequisitionController@productionAccept')->name('requisition.production.accept');
        Route::get('exports/accept/{id}', 'Admin\AdminRequisitionController@exportAccept')->name('requisition.export.accept');
        Route::get('realizations/accept/{id}', 'Admin\AdminRequisitionController@realizationAccept')->name('requisition.realization.accept');

        Route::get('productions/deny/{id}', 'Admin\AdminRequisitionController@productionDeny')->name('requisition.production.deny');
        Route::get('exports/deny/{id}', 'Admin\AdminRequisitionController@exportDeny')->name('requisition.export.deny');
        Route::get('realizations/deny/{id}', 'Admin\AdminRequisitionController@realizationDeny')->name('requisition.realization.deny');
    });

    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login/submit', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::prefix('region')->group(function (){
        Route::get('/delete/{id}','Admin\AdminRegionController@destroy')->name('region.delete');
        Route::get('/create','Admin\AdminRegionController@create')->name('region.create');
        Route::post('/store','Admin\AdminRegionController@store')->name('region.store');
        Route::get('/edit/{id}','Admin\AdminRegionController@edit')->name('region.edit');
        Route::post('/update/{id}', 'Admin\AdminRegionController@update')->name('region.update');
    });
    Route::prefix('leader')->group(function (){
        Route::get('show/{id}','Admin\AdminLeaderController@show')->name('leader.show');
        Route::get('delete/{id}','Admin\AdminLeaderController@destroy')->name('leader.delete');
        Route::get('create','Admin\AdminLeaderController@create')->name('leader.create');
        Route::post('store','Admin\AdminLeaderController@store')->name('leader.store');
        Route::get('edit/{id}','Admin\AdminLeaderController@edit')->name('leader.edit');
        Route::post('update/{id}','Admin\AdminLeaderController@update')->name('leader.update');
    });
    Route::prefix('city')->group(function (){
        Route::get('delete/{id}','Admin\AdminCityController@destroy')->name('city.delete');
        Route::get('create','Admin\AdminCityController@create')->name('city.create');
        Route::post('store','Admin\AdminCityController@store')->name('city.store');
        Route::get('edit/{id}','Admin\AdminCityController@edit')->name('city.edit');
        Route::post('update/{id}','Admin\AdminCityController@update')->name('city.update');
    });
    Route::prefix('activity')->group(function (){
        Route::get('delete/{id}','Admin\AdminActivityController@destroy')->name('activity.delete');
        Route::get('create','Admin\AdminActivityController@create')->name('activity.create');
        Route::post('store','Admin\AdminActivityController@store')->name('activity.store');
        Route::get('edit/{id}','Admin\AdminActivityController@edit')->name('activity.edit');
        Route::post('update/{id}','Admin\AdminActivityController@update')->name('activity.update');
    });
    Route::prefix('family')->group(function (){
        Route::get('delete/{id}','Admin\AdminFamilyController@destroy')->name('family.delete');
        Route::get('create','Admin\AdminFamilyController@create')->name('family.create');
        Route::post('store','Admin\AdminFamilyController@store')->name('family.store');
        Route::get('edit/{id}','Admin\AdminFamilyController@edit')->name('family.edit');
        Route::post('update/{id}','Admin\AdminFamilyController@update')->name('family.update');
    });
    Route::prefix('equipment')->group(function (){
        Route::get('delete/{id}','Admin\AdminEquipmentController@destroy')->name('equipment.delete');
        Route::get('create','Admin\AdminEquipmentController@create')->name('equipment.create');
        Route::post('store','Admin\AdminEquipmentController@store')->name('equipment.store');
        Route::get('edit/{id}','Admin\AdminEquipmentController@edit')->name('equipment.edit');
        Route::post('update/{id}','Admin\AdminEquipmentController@update')->name('equipment.update');
    });
    Route::prefix('user')->group(function(){
        Route::post('/confirm/user/{id}', 'Admin\AdminUserController@store')->name('admin.user.accept');
        Route::post('/delete/user/{id}', 'Admin\AdminUserController@destroy')->name('admin.user.delete');
        Route::post('/refuse/user/{id}', 'Admin\AdminUserController@refuse')->name('admin.user.refuse');
        Route::post('/retrieve/user/{id}', 'Admin\AdminUserController@retrieve')->name('admin.user.retrieve');
        Route::get('/user/edit/{id}','Admin\AdminUserController@edit')->name('admin.user.edit');
        Route::post('/user/update/{id}','Admin\AdminUserController@update')->name('admin.user.update');
    });
});

Route::prefix('user')->group(function (){
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('settings/update/{tab?}', 'HomeController@updateForm')->name('user.update');
    Route::get('settings','HomeController@settings')->name('settings');
    Route::get('/realizations','HomeController@realizations')->name('user.realizations');
    Route::post('update/realization/{id?}','RealizationsController@update')->name('user.update.realization');
    Route::post('create/realization','RealizationsController@store')->name('user.store.realization');

    Route::get('/exports','HomeController@exports')->name('user.exports');
    Route::post('update/export/{id?}','ExportController@update')->name('user.update.export');
    Route::post('create/export','ExportController@store')->name('user.store.export');

    
    Route::get('/productions','HomeController@productions')->name('user.productions');
    Route::post('update/production/{id?}','ProductionController@update')->name('user.update.production');
    Route::post('create/production','ProductionController@store')->name('user.store.production');

    Route::any('get/realizations','UserAjaxController@getRealization')->name('user.get.realization');
    Route::any('get/exports','UserAjaxController@getExport')->name('user.get.export');
    Route::any('get/productions','UserAjaxController@getProduction')->name('user.get.production');
    Route::get('/', 'HomeController@index')->name('home');

});
Route::prefix('leader')->group(function(){
    Route::get('login', 'Auth\LeaderLoginController@showLoginForm')->name('leader.login');
    Route::post('login/submit', 'Auth\LeaderLoginController@login')->name('leader.login.submit');
    Route::get('logout', 'Auth\LeaderLoginController@logout')->name('leader.logout');
    Route::get('/', 'Leader\LeaderController@requestList')->name('leader.index');
    Route::post('/confirm/user/{id}', 'Leader\LeaderController@acceptUser')->name('leader.user.accept');
    Route::post('/delete/user/{id}', 'Leader\LeaderController@destroyUser')->name('leader.user.delete');
    Route::post('/refuse/user/{id}', 'Leader\LeaderController@refuseUser')->name('leader.user.refuse');
    Route::post('/retrieve/user/{id}', 'Leader\LeaderController@retrieveUser')->name('leader.user.retrieve');
    Route::get('/accepted','Leader\LeaderController@search')->name('leader.search');
    Route::get('/not_accepted','Leader\LeaderController@searchNotAccepted')->name('leader.search.notAccepted');
    Route::get('/user/edit/{id}','Leader\LeaderController@editUser')->name('leader.user.edit');
    Route::post('/user/update/{id}','Leader\LeaderController@updateUser')->name('leader.user.update');


    Route::prefix('requisition')->group(function () {
        Route::get('productions', 'Leader\LeaderRequisitionController@productions')->name('leader.requisition.production');
        Route::any('productions/ajax', 'Leader\LeaderRequisitionAjaxController@productions')->name('leader.requisition.production.ajax');
        Route::get('exports', 'Leader\LeaderRequisitionController@exports')->name('leader.requisition.export');
        Route::any('exports/ajax', 'Leader\LeaderRequisitionAjaxController@exports')->name('leader.requisition.export.ajax');

        Route::get('realizations', 'Leader\LeaderRequisitionController@realizations')->name('leader.requisition.realization');
        Route::any('realizations/ajax', 'Leader\LeaderRequisitionAjaxController@realizations')->name('leader.requisition.realization.ajax');

        Route::get('productions/accept/{id}', 'Leader\LeaderRequisitionController@productionAccept')->name('leader.requisition.production.accept');
        Route::get('exports/accept/{id}', 'Leader\LeaderRequisitionController@exportAccept')->name('leader.requisition.export.accept');
        Route::get('realizations/accept/{id}', 'Leader\LeaderRequisitionController@realizationAccept')->name('leader.requisition.realization.accept');

        Route::get('productions/deny/{id}', 'Leader\LeaderRequisitionController@productionDeny')->name('leader.requisition.production.deny');
        Route::get('exports/deny/{id}', 'Leader\LeaderRequisitionController@exportDeny')->name('leader.requisition.export.deny');
        Route::get('realizations/deny/{id}', 'Leader\LeaderRequisitionController@realizationDeny')->name('leader.requisition.realization.deny');
    });

});

Route::post('/form_submit/{type}', 'Web\WebController@submitForm')->name('submit.form');

Route::get('/{type?}', 'Web\WebController@showForm')->name('web.show.form');
