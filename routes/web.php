<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('leader')->group(function(){
    Route::get('login', 'Auth\LeaderLoginController@showLoginForm')->name('leader.login');
    Route::post('login/submit', 'Auth\LeaderLoginController@login')->name('leader.login.submit');
    Route::get('logout', 'Auth\LeaderLoginController@logout')->name('leader.logout');
    Route::get('/', 'Leader\LeaderController@requestList')->name('leader.index');
    Route::post('/confirm/user/{id}', 'Leader\LeaderController@acceptUser')->name('leader.user.accept');
    Route::post('/refuse/user/{id}', 'Leader\LeaderController@refuseUser')->name('leader.user.refuse');


});
//Route::get('/', 'Web\WebController@showForm')->name('web.show.form');
Route::post('/form_submit/{type}', 'Web\WebController@submitForm')->name('submit.form');

Route::prefix('admin')->group(function (){
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

});

Route::get('setlocale/{locale}', function ($locale) {
    in_array($locale, \Config::get('app.locales'));
    return redirect()->back()->withCookie(cookie()->forever('language', $locale));
})->name('lang.switch');


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