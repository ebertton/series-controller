<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\SeasonsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;

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



Route::controller(SeriesController::class)->group(function() {
    Route::get('/series', 'index')->name('list_series');
    Route::get('/series/add', 'create')->name('form_create_series')->middleware('myAuth');
    Route::post('/series/save', 'store')->middleware('myAuth');
    Route::delete('/series/{id}', 'destroy')->middleware('myAuth');
});

Route::controller(SeasonsController::class)->group(function(){
    Route::get('/series/{serieId}/seasons', 'index');
   
});

Route::controller(EpisodeController::class)->group(function(){
    Route::get('/seasons/{season}/episodes', 'index');
    Route::post('/seasons/{season}/episodes/visualized', 'update')->middleware('myAuth');  
});


Route::controller(AccessController::class)->group(function(){
    Route::get('/access', 'index');
    Route::post('/access/auth', 'auth');  
});


Route::controller(RegisterController::class)->group(function(){
    Route::get('/register/create', 'create')->name('register_user');
    Route::post('/register/store', 'store')->name('save_user');  
});


Route::get('/logout', function () {
    Auth::logout();
    return redirect('/access');
});

Route::get('/new-series', function (){
    $email = new \App\Mail\NewSeries(
        'MD. House', 10, 1
    );
    $user = (object)[
        'email' => 'joao@teste.com',
        'name' => 'João da Silva'
    ];
    \Illuminate\Support\Facades\Mail::to($user)->send($email);
    return 'Email sent';
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
