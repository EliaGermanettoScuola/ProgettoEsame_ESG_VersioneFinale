<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\SessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    //dd('Ciao benvenuto in home.blade.php');
    return view('home');
})->name('home');

Route::post('/registrazione', [CompaniesController::class, 'registrazione']);

Route::post('/login', [CompaniesController::class, 'login']);

Route::get('/get-csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::get('/getSession', [SessionController::class, 'getSession']);

route::post('/createSession', [SessionController::class, 'CreateSession']);

route::delete('/destroySession', [SessionController::class, 'destroySession']);

route::get('/getSessionInfo', [SessionController::class, 'getSessionInfo']);