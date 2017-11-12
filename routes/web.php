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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/{type?}', 'Web\WebController@showForm')->name('web.show.form');
Route::prefix('leader')->group(function(){
    Route::get('login', 'Auth\LeaderLoginController@showLoginForm')->name('leader.login');
    Route::post('login/submit', 'Auth\LeaderLoginController@login')->name('leader.login.submit');
    Route::get('logout', 'Auth\LeaderLoginController@logout')->name('leader.logout');
    Route::get('/', 'Leader\LeaderController@requestList')->name('leader.index');
    Route::post('/confirm/user/{id}', 'Leader\LeaderController@acceptUser')->name('leader.user.accept');
});
//Route::get('/', 'Web\WebController@showForm')->name('web.show.form');
Route::post('/form_submit/{type}', 'Web\WebController@submitForm')->name('submit.form');

Route::prefix('admin')->group(function (){
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login/submit', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::prefix('region')->group(function (){
        Route::get('show/{id}','Admin\AdminRegionController@show')->name('region.show');
        Route::get('delete/{id}','Admin\AdminRegionController@destroy')->name('region.delete');
        Route::get('create','Admin\AdminRegionController@create')->name('region.create');
    });
    Route::prefix('leader')->group(function (){
        Route::get('show/{id}','Admin\AdminLeaderController@show')->name('leader.show');
        Route::get('delete/{id}','Admin\AdminLeaderController@destroy')->name('leader.delete');
        Route::get('create','Admin\AdminLeaderController@create')->name('leader.create');
    });
    Route::prefix('city')->group(function (){
        Route::get('show/{id}','Admin\AdminCityController@show')->name('city.show');
        Route::get('delete/{id}','Admin\AdminCityController@destroy')->name('city.delete');
        Route::get('create','Admin\AdminCityController@create')->name('city.create');
    });
    Route::prefix('activity')->group(function (){
        Route::get('show/{id}','Admin\AdminActivityController@show')->name('activity.show');
        Route::get('delete/{id}','Admin\AdminActivityController@destroy')->name('activity.delete');
        Route::get('create','Admin\AdminActivityController@create')->name('activity.create');
    });

});

Route::get('setlocale/{locale}', function ($locale) {
    in_array($locale, \Config::get('app.locales'));
    return redirect()->back()->withCookie(cookie()->forever('language', $locale));
})->name('lang.switch');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
