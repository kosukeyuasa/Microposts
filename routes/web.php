<?php

Route::get('/', 'MicropostsController@index');
Route::resource('microposts', 'MicropostsController');

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');



Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
});

Route::group(['prefix' => 'users/{id}'], function () {

Route::post('follow', 'UserFollowController@store')->name('user.follow');
Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
Route::get('followings', 'UsersController@followings')->name('users.followings');
Route::get('followers', 'UsersController@followers')->name('users.followers');
    });

Route::group(['prefix' => 'users/{id}'], function () {
    Route::post('favorite', 'FavoritesController@store')->name('users.favorite');
    Route::delete('unfavorite', 'FavoritesController@destroy')->name('users.unfavorite');
    Route::get('favoritings', 'FavoritesController@favoritings')->name('users.favoritings');
});



