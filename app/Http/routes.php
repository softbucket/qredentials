<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::filter('auth', function()
{
    if (!Auth::check())
    {
        return "q";
    }
});

Route::get('/', array('as' => '/', 'uses' => 'HomeController@index'));

Route::post('mobile/login', 			array('as' => 'mobile/login', 'uses' => 'MobileController@login'));
Route::get('mobile/userName', 			array('before' => 'auth', 'as' => 'mobile/userName', 'uses' => 'MobileController@userName'));
Route::get('mobile/view_qredentials', 	array('before' => 'auth', 'as' => 'mobile/view_qredentials', 'uses' => 'MobileController@get_all_info_session_relation'));
Route::get('mobile/logout', 			array('before' => 'auth', 'as' => 'mobile/logout', 'uses' => 'MobileController@logout'));
Route::post('mobile/submit_unique_key', 	array('before' => 'auth', 'as' => 'mobile/submit_unique_key', 'uses' => 'MobileController@submit_unique_key'));
Route::post('mobile/submit_profile', 	array('before' => 'auth', 'as' => 'mobile/submit_profile', 'uses' => 'MobileController@submit_profile'));
Route::get('mobile/get_all_active_info_sessions', 	array('before' => 'auth', 'as' => 'mobile/get_all_active_info_sessions', 'uses' => 'MobileController@get_all_active_info_sessions'));
Route::post('mobile/delete_info_session', array('as' => 'mobile/delete_info_session', 'uses' => 'MobileController@delete_info_session'));
Route::post('mobile/create_info_session', 	array('before' => 'auth', 'as' => 'mobile/create_info_session', 'uses' => 'UserInfoSessionsController@create'));



Route::get('view_qredentials', array('as' => 'view_qredentials', 'uses' => 'UsersController@view_qredentials'));
Route::get('scan_qredentials', array('as' => 'scan_qredentials', 'uses' => 'UsersController@scan_qredentials'));
Route::post('submit_unique_key', array('as' => 'submit_unique_key', 'uses' => 'UsersController@submit_unique_key'));

Route::get('create_profile', array('as' => 'create_profile', 'uses' => 'UsersController@create_profile'));
Route::get('view_profiles', array('as' => 'view_profiles', 'uses' => 'UsersController@view_profiles'));
Route::post('submit_profile', array('as' => 'submit_profile', 'uses' => 'UserAccessProfilesController@create'));
Route::post('search', array('as' => 'search', 'uses' => 'UsersController@search'));

Route::get('site_map', array('as' => 'site_map', 'uses' => 'HomeController@site_map'));
Route::get('site_map.xml', array('as' => 'site_map.xml', 'uses' => 'HomeController@site_map_xml'));
Route::get('search', array('as' => 'search', 'uses' => 'HomeController@index'));

Route::get('user', 'UsersController@index');
Route::get('userName', 'UsersController@userName');

Route::get('home', array('as' => 'home', 'uses' => 'HomeController@index'));
Route::get('about', array('as' => 'about', 'uses' => 'HomeController@about'));
Route::get('contact', array('as' => 'contact', 'uses' => 'HomeController@contact'));
Route::post('contact', array('as' => 'contact', 'uses' => 'HomeController@contact'));
Route::get('login', array('as' => 'login', 'uses' => 'AuthenticationController@login'));
Route::get('logout', array('as' => 'logout', 'uses' => 'AuthenticationController@logout'));
Route::get('register', array('as' => 'register', 'uses' => 'AuthenticationController@register'));

Route::get('quick_scan_unique_key', array('as' => 'quick_scan_unique_key', 'uses' => 'UserInfoSessionsController@scan_unique_key'));
Route::post('delete_info_session', array('as' => 'delete_info_session', 'uses' => 'UserInfoSessionsController@delete_info_session'));

Route::resource('Events', 'EventssController');
Route::resource('EventParticipants', 'EventParticipantsController');
Route::resource('Users', 'UsersController');
Route::resource('UserAccessProfiles', 'UserAccessProfilesController');
Route::resource('UserInfoSessions', 'UserInfoSessionsController');
Route::resource('Authentication', 'AuthenticationController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
