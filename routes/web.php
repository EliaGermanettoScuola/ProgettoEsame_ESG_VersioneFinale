<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\QuestionsController;

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
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/error', function () {
    return view('error');
})->name('error');

Route::get('/loginPage', function () {
    return view('login');
})->name('loginPage');

Route::get('/PaginaRegistrazione', function () {
    return view('registrazione');
})->name('PaginaRegistrazione');

Route::get('/get-csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

#region companies
Route::post('/registrazione', [CompaniesController::class, 'registrazione'])->name('registrazione');

Route::post('/login', [CompaniesController::class, 'login'])->name('login');

route::post('/logout', [CompaniesController::class, 'logout'])->name('logout');
#endregion

#region session
Route::get('/getSession', [SessionController::class, 'getSession']);

route::post('/createSession', [SessionController::class, 'CreateSession']);

route::delete('/destroySession', [SessionController::class, 'destroySession']);

route::get('/getSessionInfo', [SessionController::class, 'getSessionInfo']);
#endregion

#region questions

Route::get('/questionario', [QuestionsController::class, 'index'])->name('questionario');

route::get('/getAllQuestions', [QuestionsController::class, 'getAllQuestions'])->name('getAllQuestions');

route::get('/getQuestion/{id}', [QuestionsController::class, 'getQuestion']);

route::delete('/deleteQuestion/{id}', [QuestionsController::class, 'deleteQuestion']);
#endregion