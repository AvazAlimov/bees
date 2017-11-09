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

Route::get('/', function (){
   return view('main');
});
//Route::get('/', 'Web\WebController@showForm')->name('web.show.form');
Route::post('/form_submit', 'Web\WebController@submitForm')->name('web.submit.form');


Route::get('setlocale/{locale}', function ($locale) {
    in_array($locale, \Config::get('app.locales'));
    return redirect()->back()->withCookie(cookie()->forever('language', $locale));
})->name('lang.switch');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
