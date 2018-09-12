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
use App\Service;

Route::get('/', function () {
	$services = Service::all();
    return view('index', compact('services'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admindash/{component}', function ($component) {

    return view('admin.dashboard', compact('component'));
    
})->name('admindash');

Route::get('order/{id}', 'OrderController@order');

Route::get('orders/status/{status}', 'OrderController@orderByStatus');

Route::resource('requests', 'RequestController');

Route::get('requests/assign/{id}', 'RequestController@assign');

Route::get('agent-orders/status/{status}', 'OrderController@agentOrderByStatus');


Route::get('agentstats', 'DashboardController@agentstats');

Route::post('orders/work', 'OrderController@submitWork');

Route::get('orders/close/{id}', 'OrderController@closeOrder');

Route::get('orders/send-order/{id}', 'OrderController@sendOrder');


Route::get('/mailable', function () {
    $order = App\Order::find(5);

    $services = App\Service::all();

    return new App\Mail\SendOrder($order, $services);
});