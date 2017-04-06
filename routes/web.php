<?php

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'HomeController@getPage');
Route::get('/coming_soon', 'ComingSoonController@getPage');

/*
|--------------------------------------------------------------------------
| Project General Routes
|--------------------------------------------------------------------------
*/

/*Route::get('projects')*/
Route::get('/projects/{project_id}/{project_name}', 'ProjectController@getIndividualProject')->name('individual.project');

/*
|--------------------------------------------------------------------------
| Project Specific Routes
|--------------------------------------------------------------------------
*/

Route::get('/projects/1/Selma Lagerlöf Project/{topic_id}', 'LagerlöfIndividualController@getIndividualTopic');
Route::get('/projects/1/Selma Lagerlöf Project/word_comparison/{word}/{topic_id}', 'LagerlöfWordController@getWordWithTopic');
Route::get('/projects/1/Selma Lagerlöf Project/word_comparison/{topic_id}', 'LagerlöfWordController@getWordWithoutTopic');