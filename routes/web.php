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

Route::get('/', 'Web\WebController@showForm1')->name('web.show.form1');
Route::prefix('leader')->group(function(){
    Route::get('login', 'Auth\LeaderLoginController@showLoginForm')->name('leader.login');
    Route::post('login/submit', 'Auth\LeaderLoginController@login')->name('leader.login.submit');
    Route::get('logout', 'Auth\LeaderLoginController@logout')->name('leader.logout');
    Route::get('/', 'Leader\LeaderController@requestList')->name('leader.index');
    Route::post('/confirm/user/{id}', 'Leader\LeaderController@acceptUser')->name('leader.user.accept');
});
//Route::get('/', 'Web\WebController@showForm')->name('web.show.form');
Route::post('/form_submit', 'Web\WebController@submitForm')->name('web.submit.form');

Route::prefix('admin')->group(function (){
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login/submit', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
});

Route::get('setlocale/{locale}', function ($locale) {
    in_array($locale, \Config::get('app.locales'));
    return redirect()->back()->withCookie(cookie()->forever('language', $locale));
})->name('lang.switch');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
