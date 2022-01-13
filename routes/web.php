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

// Route::get('/', 'Page@home')->name('login');



Route::post('/play', 'TestController@play');

Route::post('/api/interkassa', 'InterkassaController@paymentHandler');

Route::group(['prefix' => '/admin', 'middleware' => 'auth', 'middleware' => 'access:admin'], function () {
	Route::get('/withdraws', ['as' => 'admin.withdraws', 'uses' => 'AdminController@withdraws']);
	Route::get('/withdraw/withdraw/{id}', 'PaysController@withdrawSend');
    Route::get('/withdraw/return/{id}', 'AdminController@withdrawReturn');
    Route::get('/withdraw/hide/{id}', 'AdminController@withdrawHide');

    Route::get('/payment/payment/{id}', 'PaysController@paymentSend');
    Route::get('/payment/return/{id}', 'AdminController@paymentReturn');

	Route::post('/reviewsAjax', 'AdminController@reviewsAjax');
	Route::get('/reviews_editing/{id}', 'AdminController@reviews_editing');
	Route::get('/reviews', 'AdminController@reviews');
	Route::get('/reviews/del/{id}', 'AdminController@reviews_del');
	Route::post('/reviews/save', 'AdminController@reviewsSave');
	Route::post('/reviews/add', 'AdminController@addReviews');

	Route::post('/plansAjax', 'AdminController@plansAjax');
	Route::get('/plans', 'AdminController@plans');
	Route::get('/plans_editing/{id}', 'AdminController@plans_editing');
	Route::post('/plans/save', 'AdminController@plansSave');

	Route::post('/paymentsAjax', 'AdminController@paymentsAjax');

	Route::get('/payments', ['as' => 'admin.payments', 'uses' => 'AdminController@payments']);

	Route::post('/newsAjax', 'AdminController@newsAjax');
	Route::get('/news_editing/{id}', 'AdminController@news_editing');
	Route::get('/news', 'AdminController@news');
	Route::get('/news/del/{id}', 'AdminController@news_del');
	Route::post('/news/save', 'AdminController@newsSave');
	Route::post('/news/add', 'AdminController@addNews');

	Route::post('/setting/save', 'AdminController@settingsSave');
	Route::get('/settings', ['as' => 'admin.settings', 'uses' => 'AdminController@settings']);
	Route::get('home', 'AdminController@index');
	Route::get('/users', ['as' => 'admin.users', 'uses' => 'AdminController@users']);
	Route::post('/getUserByMonth', 'AdminController@getUserByMonth');
	Route::post('/getDepsByMonth', 'AdminController@getDepsByMonth');
	Route::post('/usersAjax', 'AdminController@usersAjax');

	Route::post('/usersRefAjax/{code_ref}', 'AdminController@usersRefAjax');
	Route::get('/user/{id}', ['as' => 'admin.user', 'uses' => 'AdminController@user']);
	Route::post('/user/save', 'AdminController@userSave');

	Route::post('/getBalanceFK', 'PaysController@getBalanceEPayCore');
	Route::post('/getBalancePE', 'PaysController@getBalancePayeer');

	// Route::get('/', ['as' => 'admin.index', 'uses' => 'AdminController@index']);
});
// Route::get('/home2', 'AdminController@home');

Route::group(['middleware' => 'auth', 'middleware' => 'access:admin'], function () {
	Route::post('/ban', 'AdminController@ban');
});	

Route::group(['middleware' => 'auth'], function () {
	Route::get('/payment/create', 'PaymentController@test');

	Route::get('/slot/{identifier}/real', 'PageController@realSlot');
	Route::get('/slot/{identifier}/real{_dynamics}', 'PageController@realSlot');
	Route::get('/profile', 'PageController@profile');
	Route::get('/profile{_dynamics}', 'PageController@profile');
	Route::get('/logout', 'Controller@logout');
	Route::post('/update_avatar', 'FunctionController@update_avatar');
	Route::post('/info_user_secondary_save', 'FunctionController@info_user_secondary_save');
	Route::post('/promo_activ', 'FunctionController@promo_activ');
	Route::post('/submit_Verification', 'FunctionController@submit_Verification');
	Route::post('/change_password', 'FunctionController@change_password');

	Route::post('/setting_alerts', 'FunctionController@setting_alerts');
});

Route::group(['middleware' => 'guest'], function () {
	Route::post('/signup', 'Controller@signup');
	Route::post('/login', 'Controller@login');
	Route::post('/reset', 'Controller@reset');
	Route::get('/recovery_telephone', 'Controller@recovery_telephone');

	Route::post('/check_pass', 'Controller@check_pass');
	Route::post('/check_pass_next', 'Controller@check_pass_next');
});

// Route::get('/slot', 'PageController@slot');
Route::get('/slot/{identifier}/demo', 'PageController@demoSlot');
Route::get('/slot/{identifier}/demo{_dynamics}', 'PageController@demoSlot');
Route::post('/provider_activ', 'FunctionController@provider_activ');
Route::post('/search_slots', 'FunctionController@search_slots');

Route::get('/', 'PageController@home')->name('login');
Route::get('/home{_dynamics}', 'PageController@home');
Route::post('/locale', 'Controller@locale');

Route::get('/r/{ref}', 'PageController@home_ref');

Route::group(['prefix' => '/telegram'], function () {
	
	Route::any('/handling_user_messages', 'TelegramController@index');
});