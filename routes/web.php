<?php


Route::get('/', 'HomeController@index')->name('index');

Route::get('/filter-fields', 'HomeController@getFilteredFields');
