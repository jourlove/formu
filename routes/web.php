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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('forms', 'Front\FormController@index')->name('forms');
    Route::get('form/{id}', 'Front\FormController@show')->name('form');
    Route::post('form/save', 'Front\FormController@create')->name('form::save');
    Route::get('form/answers/{id}', 'Front\FormController@answers')->name('form::answers');
    Route::get('home', 'HomeController@index')->name('home');
});

//Super admin
Route::prefix('admin')->name('admin::')->group(function() {

    Route::get('/', 'Admin\AdminController@index')->name('home')->middleware('auth:admin');
    
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Admin\Auth\LoginController@login');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('logout');

    Route::resource('roles', 'Admin\RolesController')->middleware('auth:admin');
    Route::resource('permissions', 'Admin\PermissionsController')->middleware('auth:admin');
    Route::resource('users', 'Admin\UsersController')->middleware('auth:admin');

    Route::get('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator'])->middleware('auth:admin');
    Route::post('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator'])->middleware('auth:admin');
    
    Route::get('forms', 'Admin\FormController@index')->name('forms')->middleware('auth:admin');
    Route::get('form/new', 'Admin\FormController@new')->name('form::new')->middleware('auth:admin');
    Route::get('form/delete/{id}', 'Admin\FormController@delete')->name('form::delete')->middleware('auth:admin');    
    Route::get('form/{id}', 'Admin\FormController@update')->name('form::update')->middleware('auth:admin'); 
    Route::post('form/save', 'Admin\FormController@save')->name('form::save')->middleware('auth:admin');
    Route::get('form/answers/{id}', 'Admin\FormController@answers')->name('form::answers')->middleware('auth:admin');

    Route::get('form/analyzer/index/{id}', 'Admin\FormController@analyzerlist')->name('form::analyzerlist')->middleware('auth:admin');    
    Route::get('form/analyzer/{id}', 'Admin\FormController@analyzer')->name('form::analyzer')->middleware('auth:admin');
    Route::post('form/analyzer/save', 'Admin\FormController@analyzerSave')->name('form::analyzer:save')->middleware('auth:admin');
    Route::get('form/analyzer/delete/{id}', 'Admin\FormController@analyzerDelete')->name('form::analyzer::delete')->middleware('auth:admin');

    Route::resource('categories', 'Admin\\CategoriesController')->middleware('auth:admin');
    Route::resource('products', 'Admin\\ProductsController')->middleware('auth:admin');
});
