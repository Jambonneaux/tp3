<?php 
use App\Controllers\MeatController;
use App\Controllers\OriginController;
use App\Controllers\QualityController;
use App\Controllers\TypeController;
use App\Controllers\SupplierController;
use App\Controllers\EmployeeController;
use App\Controllers\AuthController;
use App\Controllers\TrackerController;
use App\Routes\Route;



//Route::get('/', 'MeatController@index');
Route::get('/meat', 'MeatController@index');

Route::get('/meat/show', 'MeatController@show');
Route::post('/meat/show', 'MeatController@show');

Route::get('/meat/create', 'MeatController@create');
Route::post('/meat/create', 'MeatController@store');

Route::get('/meat/edit', 'MeatController@edit');
Route::post('/meat/edit', 'MeatController@update');

Route::post('/meat/delete', 'MeatController@delete');

Route::get('/employee/create', 'EmployeeController@create');
Route::post('/employee/create', 'EmployeeController@store');

Route::get('/tracker', 'TrackerController@index');
Route::post('/tracker', 'TrackerController@store');

Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');



Route::dispatch();




?>