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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'GroupsController@index');

Route::resource('groups', 'GroupsController')->middleware('auth');
Route::resource('members', 'MembersController')->middleware('auth');
Route::resource('products', 'ProductsController')->middleware('auth');
Route::resource('homes', 'HomesController');
Route::resource('cars', 'CarsController');
Route::resource('subscriptions', 'SubscriptionsController');
Route::resource('payments', 'PaymentsController');

Route::get('/groups/{id}/template', function ( $groupId ) {
    return view('groups.show', [
        'userid' => Auth::user()->id,
        'groupid' => $groupId
    ]);
})->middleware('auth');

Route::patch('/groups', 'GroupsController@update')->middleware('auth');
Route::get('/members/{groupId}/index', 'MembersController@index')->middleware('auth');
Route::patch('/members', 'MembersController@update')->middleware('auth');

Route::get('/products/{id}/template', function ( $productId ) {
    return view('products.show', [
        'userid' => Auth::user()->id,
        'productid' => $productId 
    ]);
})->middleware('auth');

Route::patch('/products', 'ProductsController@update')->middleware('auth');
