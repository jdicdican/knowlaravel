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

Route::get('/', 'DashboardController@redirectToAppropriateRoute')->name('index');

// Auth::routes();
// Authentication Routes...
$this->get('user/login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('user/login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('articles', 'ArticlesNavigationController@index')->name('articles');
Route::get('articles/most_liked', 'ArticlesNavigationController@mostLiked')->name('most_liked');
Route::get('articles/published', 'ArticlesNavigationController@published')->middleware('author')->name('published');
Route::get('articles/drafts', 'ArticlesNavigationController@drafts')->middleware('author')->name('drafts');

Route::get('articles/create', 'ArticlesController@create')->middleware('author')->name('create-article');
Route::post('articles/save/{id?}', 'ArticlesController@save')->middleware('author')->name('save-article');
Route::get('articles/delete/{id}', 'ArticlesController@delete')->middleware('author')->name('delete-article');
Route::get('articles/update/{id}', 'ArticlesController@update')->middleware('author')->name('update-article');
Route::get('articles/like/{id}', 'ArticlesController@like')->name('like-article');
