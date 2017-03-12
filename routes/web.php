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

Route::get('/', 'HomeController@getPage');
Route::get('projects/{project_id}/{project_name}', 'ProjectController@getIndividualProject')->name('individual.project');
Route::get('coming_soon', 'ComingSoonController@getPage');

/*
Route::get('projects')

*/