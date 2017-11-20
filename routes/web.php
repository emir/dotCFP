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

Route::redirect('/home', '/');

Route::view('/', 'home')->name('home');

Route::get('/login/github', 'LoginController@redirectToProvider')->name('login');

Route::get('/login/github/callback', 'LoginController@handleProviderCallback');

Route::get('/committee', 'CommitteeController@index')->name('committee.index');

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

    /**
     * User
     */
    Route::get('/users', 'UsersController@index')->name('users.index')->middleware(['role:admin|reviewer']);
    Route::get('/users/{user}', 'UsersController@show')->name('users.show')->middleware(['role:admin|reviewer']);
    Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit')->middleware(['can:edit,user']);
    Route::get('/users/{user}/roles', 'UsersController@roleAction')->name('users.roles')->middleware(['role:admin']);

    Route::post('/users/{user}/roles', 'UsersController@roleAction')->name('users.roles')->middleware(['role:admin']);

    Route::put('/users/{user}/update', 'UsersController@update')->name('users.update')->middleware(['can:update,user']);

    /**
     * Talks
     */
    Route::get('/talks', 'TalksController@index')->name('talks.index');
    Route::get('/talks/create', 'TalksController@create')->name('talks.create');
    Route::get('/talks/{talk}', 'TalksController@show')->name('talks.show')->middleware(['role:admin|reviewer']);

    Route::get('/talks/{talk}/edit', 'TalksController@edit')->name('talks.edit')->middleware(['can:edit,talk']);
    Route::get('/talks/{talk}/delete', 'TalksController@destroy')->name('talks.destroy')->middleware(['can:delete,talk']);

    Route::post('/talks', 'TalksController@store')->name('talks.store');
    Route::post('/talks/{talk}/comments', 'CommentsController@store')->name('talks.comments')->middleware(['role:admin|reviewer']);
    Route::post('/talks/{talk}/vote', 'TalksController@voteAction')->name('talks.vote')->middleware(['role:admin|reviewer']);
    Route::post('/talks/{talk}/approve', 'TalksController@approveAction')->name('talks.approve')->middleware(['role:admin']);

    Route::put('/talks/{talk}/update', 'TalksController@update')->name('talks.update')->middleware(['can:update,talk']);

    /**
     * Comments
     */
    Route::get('/comments/{comment}/delete', 'CommentsController@destroy')->name('comments.destroy')->middleware(['role:admin|reviewer', 'can:delete,comment']);
});
