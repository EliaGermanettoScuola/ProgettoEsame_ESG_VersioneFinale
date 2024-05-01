<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\QuestionnairesController;
use App\Http\Controllers\AnswerSurveyController;

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

Route::get('/chisiamo', function () {
    return view('chisiamo');
})->name('chisiamo');

Route::get('/loginPage', function () {
    return view('login');
})->name('loginPage');

Route::get('/PaginaRegistrazione', function () {
    return view('registrazione');
})->name('PaginaRegistrazione');

Route::get('/servizi', function () {
    return view('servizi');
})->name('servizi');

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

Route::get('/questionario', [QuestionsController::class, 'questionario'])->name('questionario');

Route::get('/nuovoQuestionario', [QuestionsController::class, 'nuovoQuestionario'])->name('nuovoQuestionario');

route::get('/getQuestion/{id}', [QuestionsController::class, 'getQuestion']);

route::delete('/deleteQuestion/{id}', [QuestionsController::class, 'deleteQuestion']);
#endregion

#region questionnaires

Route::post('/createSurvey', [QuestionnairesController::class, 'createSurvey'])->name('createSurvey');

Route::get('/getUserSurvey/{id}', [QuestionnairesController::class, 'getUserSurvey'])->name('getUserSurvey');

Route::get('/getSurvey/{id}', [QuestionnairesController::class, 'getSurvey'])->name('getSurvey');

Route::get('/destroySurvey/{id}', [QuestionnairesController::class, 'destroySurvey'])->name('destroySurvey');
#endregion

#region answerSurvey

Route::post('/saveAnswer', [AnswerSurveyController::class, 'saveAnswer'])->name('saveAnswer');

Route::get('/calcoloFinale', [AnswerSurveyController::class, 'calcoloFinale'])->name('calcoloFinale');

#endregion