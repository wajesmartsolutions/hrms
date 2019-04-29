<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('assignPermission','RoleController@assignPermission');
Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');
Route::post('opennings','JoblistingController@create');
Route::post('appliedjobposting','ApplyjobsController@appliedjobposting');
Route::get('listappliedjobposting','ApplyjobsController@listappliedjobposting');
Route::get('listopenings','JoblistingController@retrieve');
Route::get('sendbasicemail','MailController@basic_email');
Route::post('assignuserrole','RoleController@assignUserRole'); //assign role to user
Route::resource('joblistng', 'JoblistingController');
Route::resource('question', 'Interview_questionsController');
Route::post('question/{$id}','Interview_questionsController@checkAnswer'); //check answer
Route::resource('company', 'CompanyController');
Route::resource('roles', 'RoleController');
Route::group(['middleware' => 'auth:api'], function(){
Route::get('details', 'PassportController@details');
//Route::resource('question', 'Interview_questionsController');
});

Route::post('updateUser','PassportController@updateUser');

Route::resource('cbtQuestion', 'CbtController');
