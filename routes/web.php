<?php
use Illuminate\Support\Facades\App;

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

Route::get('/bridge', function() {
    $pusher = App::make('pusher');

    $pusher->trigger( 'test-channel',
                      'test-event', 
                      array('text' => 'Preparing the Pusher Laracon.eu workshop!'));

    return view('welcome');
});

Route::get('/notifications', 'NotificationController@getIndex');
Route::post('/notifications/notify', 'NotificationController@postNotify');
Route::get('auth/github', 'Controller@redirectToProvider');
Route::get('auth/github/callback', 'Controller@handleProviderCallback');
Route::get('/activities', 'ActivityController@getIndex');
Route::post('/activities/status-update', 'ActivityController@postStatusUpdate');