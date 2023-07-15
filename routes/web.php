<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


## start constants   #####################################
define('ARTICLES_PAGINATION_COUNT', 12);
define('RELATED_ARTICLES_COUNT', 8);
define('TABLES_PAGINATION_COUNT', 16);
#######################################  End constants  ## 




Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
			'localeSessionRedirect', 
			'localizationRedirect', 
			'localeViewPath', 
			'localeCookieRedirect',
			'VisitorLocationRedirect'			
	]
], function(){
	
	
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('about', 'HomeController@about')->name('about');
	Route::get('contact', 'HomeController@contact')->name('contact');
	
	Route::namespace('Guest')->group(function(){
				
		Route::get('article/{article_id}', 'ArticleController@show')->name('article');	
		
		Route::get('categories/{id}', 'CategoryController@show')->name('subcategory');		
		Route::post('categories', 'CategoryController@index')->name('category');
		
		Route::post('comment', 'CommentController@store')->name('comment');
		Route::get('tags/{tag_id}', 'TagController@show')->name('tag');

    });
	
	Auth::routes([
		'login' => true,
		'logout' => true,
		'register' => true,
		'reset' => true,
		'confirm' => false,
		'verify' => false,
	]);
    


	## start Admin Routes   ################################################################################
	
    Route::name('admin.')->group(function(){
        Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function(){
			
            Route::middleware('AdminOnly')->group(function(){
				Route::get('settings', 'SettingController@index')->name('settings');
				Route::put('settings/update', 'SettingController@update')->name('settings.update');
				Route::resource('categories', 'CategoryController');
				Route::resource('members', 'UserController')->only(['index', 'destroy']);
				Route::resource('tags', 'TagController');
				Route::resource('comments', 'CommentController');
			});
			
			Route::resource('articles', 'ArticleController');
			Route::get('dashboard', 'DashboardController@index')->name('dashboard');
            Route::get('profile', 'ProfileController@index')->name('profile');
			Route::put('profile/update', 'ProfileController@update')->name('profile.update');
            // Route::resource('notification', 'NotificationController')->name('notification');
        });
    });
	
	##################################################################################  End Admin Routes  ## 
	
	

});