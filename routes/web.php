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

// Admin Routes
Route::get('admin/dashboard', 'AdminController@index')->name('admin');
Route::get('authors', 'AdminController@getAuthors')->name('authors.index');
Route::get('authors/{id}', 'AdminController@showAuthor')->name('authors.view');
Route::get('authors/edit/{id}', 'AdminController@showEditAuthor')->name('authors.edit');
Route::get('authors/confirm_delete/{id}', 'AdminController@deletePopup')->name('authors.confirm_delete');
Route::get('authors/delete/{id}', 'AdminController@deleteAuthor')->name('authors.delete');
Route::put('authors/update/{id}', 'AdminController@updateAuthor')->name('authors.update');
Route::get('/', 'HomeController@index')->name('index');

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

Route::get('dashboard', 'HomeController@index')->name('dashboard');
Route::get('dashboard/most_liked', 'HomeController@mostLiked')->name('most_liked');

Route::get('dashboard/articles/published', 'DashboardController@published')->name('published');
Route::get('dashboard/articles/drafts', 'DashboardController@drafts')->name('drafts');
Route::get('dashboard/articles/create', 'ArticlesController@create')->name('create-article');
Route::post('dashboard/articles/save/{id?}', 'ArticlesController@save')->name('save-article');
Route::get('dashboard/articles/delete/{id}', 'ArticlesController@delete')->name('delete-article');
Route::get('dashboard/articles/update/{id}', 'ArticlesController@update')->name('update-article');
Route::get('dashboard/articles/like/{id}', 'ArticlesController@like')->name('like-article');
