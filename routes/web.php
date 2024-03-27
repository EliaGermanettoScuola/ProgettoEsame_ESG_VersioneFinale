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
    return view('welcome');
});

Route::get('/home', function () {
    //dd('Ciao benvenuto in home.blade.php');
    return view('home');
})->name('home');

Route::get('/questionario', function () {
    //dd('Ciao benvenuto in questionario.blade.php');
    return view('questionario');
})->name('questionario');

Route::get('/get-csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

#region companies
Route::post('/registrazione', [CompaniesController::class, 'registrazione']);

Route::post('/login', [CompaniesController::class, 'login']);
#endregion

#region session
Route::get('/getSession', [SessionController::class, 'getSession']);

route::post('/createSession', [SessionController::class, 'CreateSession']);

route::delete('/destroySession', [SessionController::class, 'destroySession']);

route::get('/getSessionInfo', [SessionController::class, 'getSessionInfo']);
#endregion

#region questions
route::get('/getAllQuestions', [QuestionsController::class, 'getAllQuestions']);

route::get('/getQuestion/{id}', [QuestionsController::class, 'getQuestion']);

route::delete('/deleteQuestion/{id}', [QuestionsController::class, 'deleteQuestion']);
#endregion