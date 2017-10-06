<?php

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'HomeController@getPage');
Route::get('/home', 'HomeController@getPage');
Route::get('/coming_soon', 'ComingSoonController@getPage');
Route::get('/logout', 'Auth\LogoutController@logout');
Auth::routes();

/*
|--------------------------------------------------------------------------
| Project General Routes
|--------------------------------------------------------------------------
*/

Route::get('/projects/{project_id}/{project_name}', 'ProjectController@getIndividualProject')->name('individual.project');
Route::get('/projects', 'ProjectController@getAllProjects');
Route::get('/blogs/{project_id}/{project_name}', 'BlogController@getIndividualBlog')->name('individual.blog');
Route::get('/blogs/{project_id}/{project_name}/{blog_entry}', 'BlogController@getIndividualBlogPost');
Route::post('/blogs/{project_id}/{project_name}/sql_update/{author}', 'SQLUpdateController@getBlogPost');
Route::post('/blogs/{project_id}/{project_name}/sql_update/{author}/{blog_entry}', 'SQLUpdateController@getBlogUpdate');
Route::get('/blogs/{project_id}/{project_name}/sql_delete/{blog_entry}', 'SQLUpdateController@deleteBlogPost');

/*
|--------------------------------------------------------------------------
| Project Specific Routes
|--------------------------------------------------------------------------
*/

Route::get('/projects/1/Selma Lagerlöf Project/{topic_id}', 'LagerlöfIndividualController@getIndividualTopic');
Route::get('/projects/1/Selma Lagerlöf Project/word_comparison/{chunk_size}/{part_of_speech}/{topic_number}/{word}', 'LagerlöfWordController@getWordComparison');
Route::post('/projects/1/Selma Lagerlöf Project/sql_update/{global_id}', 'SQLUpdateController@getLagerlöfUpdate');
