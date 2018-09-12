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

// Route::get('/', function () { // URL custom name
//     return view('welcome'); // Blade name
// });


// Route::get('/shop', function () { // URL custom name
//     return view('pages.shop'); // Blade location
// });

Route::resource('products', 'ProductsController');

Route::get('/', 'PagesController@index');

Route::get('/shop', 'PagesController@shop');



Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
