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
Route::group ( [ 'middleware' => 'auth.admin' ], function () {
    Route::get('admin/dashboard', 'AdminController@index')->name('admin');
    Route::get('authors', 'AdminController@getAuthors')->name('authors.index');
    Route::get('authors/{id}', 'AdminController@showAuthor')->name('authors.view');
    Route::get('authors/edit/{id}', 'AdminController@showEditAuthor')->name('authors.edit');
    Route::get('authors/confirm_delete/{id}', 'AdminController@deletePopup')->name('authors.confirm_delete');
    Route::get('authors/delete/{id}', 'AdminController@deleteAuthor')->name('authors.delete');
    Route::put('authors/update/{id}', 'AdminController@updateAuthor')->name('authors.update');
    Route::get('authors/view/{id}', 'AdminController@showAllAuthorArticles')->name('author.articles');
});

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
Route::get('articles/like/{id}', 'ArticlesController@like')->name('like-article');

//Bookmarks Routes
Route::get('articles/bookmarks/{id}', 'ArticlesController@bookmarkArticle')->name('bookmark');
Route::get('articles/bookmarks', 'ArticlesNavigationController@getBookmark')->name('bookmarks.list');
Route::get('articles/view/{id}', 'ArticlesController@showArticle')->name('article.view');

Route::group( [ 'middleware' => 'author' ], function () {
    Route::get('articles/published', 'ArticlesNavigationController@published')->name('published');
    Route::get('articles/drafts', 'ArticlesNavigationController@drafts')->name('drafts');
    Route::get('articles/create', 'ArticlesController@create')->name('create-article');
    Route::post('articles/save/{id?}', 'ArticlesController@save')->name('save-article');
    Route::get('articles/delete/{id}', 'ArticlesController@delete')->name('delete-article');
    Route::get('articles/update/{id}', 'ArticlesController@update')->name('update-article');
});
