<?php

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

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

});
//Route::get('/', 'Web\WebController@showForm')->name('web.show.form');
Route::post('/form_submit/{type}', 'Web\WebController@submitForm')->name('submit.form');

Route::prefix('admin')->group(function (){
    Route::get('test','Admin\AdminController@ishlab');
    Route::get('swot','Admin\AdminController@swot');
    Route::get('get/swot/{id?}','Admin\AdminController@getSwot')->name('getSwot');
    Route::get('get/regions','Admin\AdminController@getRegion')->name('getRegion');
    Route::get('region/excel','Admin\AdminController@regionExport')->name('region.export');
    Route::get('excel/{id?}','Admin\AdminController@swotExport')->name('swot.export');
    Route::get('ishlabchiqarish','Admin\AdminController@ishlabchiqarish')->name('ishlabchiqarish.data');
    Route::get('ishlabchiqarish/excel','Admin\AdminController@ishlabchiqarishExport')->name('ishlabchiqarish.export');
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::get('index', 'Admin\AdminController@index2')->name('admin.index2');
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

Route::get('setlocale/{locale}', function ($locale) {
    in_array($locale, \Config::get('app.locales'));
    return redirect()->back()->withCookie(cookie()->forever('language', $locale));
})->name('lang.switch');

Route::get('/regions', function(){
    $result = Excel::load('hudud.xlsx')->getExcel()->getSheet(0)->toArray();
    $result = collect($result);
    $items = $result->sortBy(function ($item){
        return $item[3];
    })->except(['0','1'])->unique('3')->pluck('1','3');

    foreach ($items as $key => $item){
        echo intval($key) . ' --- '. substr($item, 0,191) ."</br>";
        $result2 = Excel::load('hudud.xlsx')->getExcel()->getSheet(0)->toArray();
        $result2 = collect($result2);
        $items2 = $result2->sortBy(function ($item){
            return $item[3];
        })->except(['0','1'])->where('3', sprintf("%02d", $key))->pluck('2','0');
        foreach ($items2 as $key2 => $item2){
            echo intval($key2) . ' ` ~ ` ~ `'. substr($item2, 0,191) ."</br>";
        }
    }
    $result3 = Excel::load('banklar.xlsx')->getExcel()->getSheet(0)->toArray();
    $result3 = collect($result3);
    $items3 = $result3->except(['0','1'])->all();
    foreach ($items3 as $key3 => $item3){
        echo intval($key3) . ' ` ~ ` ~ `'. substr($item3[1], 0,5) .'~ ~ ~'. substr($item3[8], 0,191)."</br>";
    }

});
Route::prefix('user')->group(function (){
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
//    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//    Route::post('register', 'Auth\RegisterController@register');

});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{type?}', 'Web\WebController@showForm')->name('web.show.form');