<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::post('/process/ajax-requests',[App\Http\Controllers\admin\ProcessAjaxRequest::class,'ajaxRequest'])->name('process.ajaxRequest');

Auth::routes(['verify'=>true]);

Route::group(['middleware' => ['auth','verified'], 'prefix'=>'admin'], function () {


    Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

    ///General
    Route::post('/dyna-tags', 'App\Http\Controllers\admin\ProcessAjaxRequest@dynaTags')->name('getDynaTags');
    Route::post('/uploadImg', 'App\Http\Controllers\admin\ProcessAjaxRequest@uploadCkImage')->name('uploadImg');

    /// Blog
    Route::resource('/blog','App\Http\Controllers\admin\BlogController');


    /// codeMirror
    Route::resource('/custom-code', 'App\Http\Controllers\admin\CodeMirrorController');

    // Gallery route
    Route::post('gallery/mass-delete','App\Http\Controllers\admin\GalleryController@massDestroy')->name('gallery.massDelete')->can('admin');
    Route::resource('gallery','App\Http\Controllers\admin\GalleryController')->only([
        'index','store','destroy'
    ]);

    /// Static Pages
	Route::resource('/staticPages', 'App\Http\Controllers\admin\StaticPagesController')->only([
		'edit','update'
	]);


	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\admin\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\admin\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\admin\ProfileController@password']);

	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

