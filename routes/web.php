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

Auth::routes();

// Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
//Route::get('/profile', 'Photo\ProfileController@showProfile')->name('show.profile');

Route::group(['namespace' => 'Photo'], function () {
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::post('/store', 'UserController@store')->name('user.store');
    Route::get('users/{group}', 'UserController@index')->name('group.index');
    Route::get('users/{group}/{id}', 'UserController@show')->name('group.show');
    Route::delete('users/{group}/{id}', 'UserController@destroy')->name('group.destroy');
    Route::patch('users/{group}/{id}', 'UserController@update')->name('group.update');
    Route::get('users/{group}/{id}/edit', 'UserController@edit')->name('group.edit');
    
    Route::get('/profile', 'ProfileController@showProfile')->name('show.profile');
    Route::post('/save', 'ProfileController@saveProfile')->name('save.profile');
    Route::get('/edit_profile', 'ProfileController@editProfile')->name('edit.profile');
});
// Route::group(['namespace' => 'Photo'], function () {
//     Route::get('/create', 'UserController@create')->name('user.create');
//     Route::post('/store', 'UserController@store')->name('user.store');
//     Route::resource('{group}', 'UserController')
//         ->parameters([
//             '{group}' => 'id',            
//         ])
//         ->except('create', 'store')
//         ->names('group');
// });

Route::get('/', 'Photo\IndexController@init')->name('home');






//////////////////   Админка    //////////////////
// Route::group(['namespace' => 'Photo\Admin','prefix' => 'admin'], function () {
//     Route::get('/create', 'UserController@create')->name('admin.user.create');
//     Route::post('/store', 'UserController@store')->name('admin.user.store');  
//     Route::resource('{group}', 'UserController')
//         ->parameters([
//             '{group}' => 'user',            
//         ])
//         ->except('create', 'store')
//         ->names('admin.group.user');
      
// });
///////////////////////////////////////////////////


//Route::get('/home', 'HomeController@index')->name('home');
