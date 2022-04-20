<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes(['register' => false, 'reset' =>false]);

Route::middleware(['auth', 'CheckManager'])->group(function(){
  Route::get('/categories/add-category', 'CategoryController@addCategory');

  Route::post('/categories/add-category', 'CategoryController@createCategory')->name('category.add');

  Route::get('/categories/list-category', 'CategoryController@getCategories')->name('category.list');

  Route::get('/categories/delete-category/{id}','CategoryController@deleteCategory')->name('category.delete');

  Route::get('/categories/update-category','CategoryController@updateCategory')->name('category.update');

  Route::get('/categories/edit-category/{id}','CategoryController@editCategory');


  Route::get('/tables/list-tables', 'TableController@getTables')->name('tables.list');

  Route::get('/tables/add-table', 'TableController@addTable');

  Route::post('/tables/add-table', 'TableController@createTable')->name('table.add');

  Route::get('/tables/delete-table/{id}','TableController@deleteTable')->name('table.delete');

  Route::get('/tables/update-table','TableController@updateTable')->name('table.update');

  Route::get('/tables/edit-table/{id}','TableController@editTable');

  Route::get('/sizes/list-sizes', 'SizeController@getSizes')->name('sizes.list');

  Route::get('/sizes/add-size', 'SizeController@addSize');

  Route::post('/sizes/add-size', 'SizeController@createSize')->name('size.add');

  Route::get('/sizes/update-size','SizeController@updateSize')->name('size.update');

  Route::get('/sizes/edit-size/{id}','SizeController@editSize');

  Route::get('/sizes/delete-size/{id}','SizeController@deleteSize')->name('size.delete');


  Route::get('/types/add-type', 'TypeController@addType');

  Route::post('/types/add-type', 'TypeController@createType')->name('type.add');

  Route::get('/types/list-types', 'TypeController@getTypes')->name('types.list');

  Route::get('/types/delete-type/{id}','TypeController@deleteType')->name('type.delete');

  Route::put('/types/update-type','TypeController@updateType')->name('type.update');

  Route::get('/types/edit-type/{id}','TypeController@editType');


  Route::get('/menu/add-item', 'MenuController@addItem');

  Route::post('/menu/add-item', 'MenuController@createItem')->name('item.add');

  Route::get('/menu/list-items', 'MenuController@getItems')->name('items.list');

  Route::get('/menu/delete-item/{id}','MenuController@deleteItem')->name('item.delete');

  Route::get('/menu/update-item','MenuController@updateItem')->name('item.update');

  Route::get('/menu/edit-item/{id}','MenuController@editItem');

  Route::get('/salesReport', 'SalesReportController@summary')->name('salesReport.summary');

  Route::post('/salesReport/repStat', 'SalesReportController@repStat');

  Route::get('/users/list-users', 'UserController@getUsers')->name('users.list');

  Route::get('/users/add-user', 'UserController@addUser');

  Route::post('/users/add-user', 'UserController@createUser')->name('user.add');

  Route::get('/users/delete-user/{id}','UserController@deleteUser')->name('user.delete');

  Route::get('/users/update-user','UserController@updateUser')->name('user.update');

  Route::get('/users/edit-user/{id}','UserController@editUser');

});

Route::middleware(['auth','CheckUser'])->group(function(){

Route::get('/orders','OrderController@service')->name('orders.service');

Route::get('/orders/typesWithCategory/{id}', 'OrderController@typesWithCategory');

Route::post('/orders/buyItem', 'OrderController@buyItem');

Route::get('/orders/getMenuSizes/{id}', 'OrderController@getMenuSizes');

Route::get('/orders/showTables', 'OrderController@showTables');

Route::get('orders/displayOrderPositions/{id}','OrderController@displayOrderPositions');

Route::post('/orders/cancelPosition','OrderController@cancelPosition');

Route::post('/orders/getBill', 'OrderController@getBill');

Route::get('/orders/displayBill/{id}', 'OrderController@displayBill');

});

Route::middleware(['auth'])->group(function(){

Route::get('/', 'HomeController@index')->name('home');

Route::get('changePassword','Auth\ChangePasswordController@index')->name('changePassword');

Route::post('changePassword','Auth\ChangePasswordController@changePassword')->name('updatePassword');

});
