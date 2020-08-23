<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/admin', function () {
    return view('backend.login');
})->name('adminpage');

Route::get('/', 'FrontController@index')->name('front.home');
Route::get('/login', 'FrontController@login')->name('front.login');
Route::get('/register', 'FrontController@register')->name('front.register');
Route::get('/about', 'FrontController@about')->name('front.about');
Route::get('/news', 'FrontController@news')->name('front.news');
Route::get('/contact', 'FrontController@contact')->name('front.contact');
Route::post('/login', 'UserController@login_member')->name('front.login_post');
Route::post('/register', 'UserController@register_member')->name('front.register_post');
Route::get('/pitch/detail/{id}', 'FrontController@detail')->name('front.detail');
Route::get('/pitch/timesheet/{id}/date/{date}', 'FrontController@timesheet')->name('front.timesheet');
Route::post('/checkout', 'FrontController@checkout')->name('front.checkout');
Route::get('/order', 'FrontController@order')->name('front.order');
Route::get('/order/detail/{id}', 'FrontController@detail_order')->name('front.detail_order');
Route::post('/confirm', 'FrontController@confirm')->name('front.confirm');

Route::post('/adminpage/login', 'UserController@login')->name('user.login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/adminpage/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/adminpage/user/change_password', 'UserController@edit_pass')->name('user.edit_pass');
    Route::post('/adminpage/user/update_password', 'UserController@update_pass')->name('user.update_pass');
    Route::group(['middleware' => ['permission:user-*']], function() {
        Route::get('/adminpage/user', 'UserController@index')->name('user.index');
        Route::group(['middleware' => ['permission:user-create']], function() {
            Route::get('/adminpage/user/create', 'UserController@create')->name('user.create');
            Route::post('/adminpage/user', 'UserController@store')->name('user.store');
        });
        Route::get('/adminpage/user/datatable', 'UserController@show')->name("user.datatable");
        Route::group(['middleware' => ['permission:user-edit']], function() {
            Route::patch('/adminpage/user/{id}', 'UserController@update')->name("user.update");
            Route::get('/adminpage/user/{id}', 'UserController@edit')->name("user.edit");
        });
        Route::group(['middleware' => ['permission:user-delete']], function() {
            Route::delete('/adminpage/user/{id}', 'UserController@destroy')->name("user.destroy");
        });
    });
    Route::get('/adminpage/logout', 'UserController@logout')->name('user.logout');
    Route::get('/logout', 'UserController@logout_member')->name('front.logout');

    Route::group(['middleware' => ['permission:article-*']], function() {
        Route::get('/adminpage/article', 'ArticleController@index')->name('article.index');
        Route::get('/adminpage/article/create', 'ArticleController@create')->name('article.create');
        Route::post('/adminpage/article', 'ArticleController@store')->name('article.store');
        Route::get('/adminpage/article/datatable', 'ArticleController@show')->name("article.datatable");
        Route::get('/adminpage/article/{id}', 'ArticleController@edit')->name("article.edit");
        Route::patch('/adminpage/article/{id}', 'ArticleController@update')->name("article.update");
        Route::delete('/adminpage/article/{id}', 'ArticleController@destroy')->name("article.destroy");
    });

    Route::group(['middleware' => ['permission:category-*']], function() {
        Route::get('/adminpage/article_category', 'ArticleCategoryController@index')->name('article_category.index');
        Route::get('/adminpage/article_category/create', 'ArticleCategoryController@create')->name('article_category.create');
        Route::post('/adminpage/article_category', 'ArticleCategoryController@store')->name('article_category.store');
        Route::get('/adminpage/article_category/datatable', 'ArticleCategoryController@show')->name("article_category.datatable");
        Route::get('/adminpage/article_category/{id}', 'ArticleCategoryController@edit')->name("article_category.edit");
        Route::patch('/adminpage/article_category/{id}', 'ArticleCategoryController@update')->name("article_category.update");
        Route::delete('/adminpage/article_category/{id}', 'ArticleCategoryController@destroy')->name("article_category.destroy");
    });

    Route::group(['middleware' => ['permission:setting-*']], function() {
        Route::get('/adminpage/setting', 'SettingController@index')->name('setting.index');
        Route::post('/adminpage/setting', 'SettingController@store')->name('setting.store');
    });

    Route::get('/adminpage/pitch', 'PitchController@index')->name('pitch.index');
    Route::get('/adminpage/pitch/create', 'PitchController@create')->name('pitch.create');
    Route::post('/adminpage/pitch', 'PitchController@store')->name('pitch.store');
    Route::get('/adminpage/pitch/datatable', 'PitchController@show')->name("pitch.datatable");
    Route::get('/adminpage/pitch/{id}', 'PitchController@edit')->name("pitch.edit");
    Route::patch('/adminpage/pitch/{id}', 'PitchController@update')->name("pitch.update");
    Route::delete('/adminpage/pitch/{id}', 'PitchController@destroy')->name("pitch.destroy");

    Route::get('/adminpage/cash', 'CashController@index')->name('cash.index');
    Route::get('/adminpage/cash/create', 'CashController@create')->name('cash.create');
    Route::post('/adminpage/cash', 'CashController@store')->name('cash.store');
    Route::get('/adminpage/cash/datatable', 'CashController@show')->name("cash.datatable");
    Route::get('/adminpage/cash/{id}', 'CashController@edit')->name("cash.edit");
    Route::patch('/adminpage/cash/{id}', 'CashController@update')->name("cash.update");
    Route::delete('/adminpage/cash/{id}', 'CashController@destroy')->name("cash.destroy");

    Route::get('/adminpage/booking/{id}/payment/create', 'PaymentController@create')->name('payment.create');
    Route::get('/adminpage/booking/{booking_id}/payment/edit/{id}', 'PaymentController@edit')->name("payment.edit");
    Route::post('/adminpage/payment', 'PaymentController@store')->name('payment.store');
    Route::patch('/adminpage/payment/confirm/{id}', 'PaymentController@confirm')->name('payment.confirm');
    Route::get('/adminpage/payment', 'PaymentController@index')->name('payment.index');
    Route::get('/adminpage/payment/datatable', 'PaymentController@show')->name('payment.datatable');
    Route::patch('/adminpage/payment/{id}', 'PaymentController@update')->name("payment.update");
    Route::delete('/adminpage/payment/{id}', 'PaymentController@destroy')->name("payment.destroy");

    Route::get('/adminpage/booking', 'BookingController@index')->name('booking.index');
    Route::get('/adminpage/booking/detail/{id}', 'BookingController@detail')->name('booking.detail');
    Route::get('/adminpage/booking/create', 'BookingController@create')->name('booking.create');
    Route::post('/adminpage/booking', 'BookingController@store')->name('booking.store');
    Route::get('/adminpage/booking/datatable', 'BookingController@show')->name("booking.datatable");
    Route::get('/adminpage/booking/{id}', 'BookingController@edit')->name("booking.edit");
    Route::patch('/adminpage/booking/{id}', 'BookingController@update')->name("booking.update");
    Route::delete('/adminpage/booking/{id}', 'BookingController@destroy')->name("booking.destroy");

    Route::get('/adminpage/report/profit', 'BookingController@view_laba')->name('report.laba');
    Route::get('/adminpage/report/profit/datatable', 'BookingController@report_laba')->name('report.laba.datatable');
    Route::get('/adminpage/report/payment', 'PaymentController@view_report_payment')->name('report.payment');
    Route::get('/adminpage/report/payment/datatable', 'PaymentController@report_payment')->name('report.payment.datatable');
});
