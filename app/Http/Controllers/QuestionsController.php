<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\QuestionnairesController;


class QuestionsController extends Controller
{
    function questionario() {
        return view('questionario');
    }

    function nuovoQuestionario() {
        $sessionController = new SessionController;
        $sessionRequest = new Request;
        $sessionRequest->replace(['type' => 'Users']);
        $session = $sessionController->getSession($sessionRequest);
        if($session->getData()->success == false){
            return view('error', ['error' => $session->getData()->message]);
        }
        $questionnairesController = new QuestionnairesController;
        $questionnairesRequest = new Request;
        $questionnairesRequest->replace(['idUtente' => $session->getData()->data->Users, 'stato' => '1']);
        $questionnaire = $questionnairesController->createSurvey($questionnairesRequest);
        if($questionnaire->getData()->success == false){
            return view('error', ['error' => $questionnaire->getData()->error]);
        }
        
        $questions = $this->getAllQuestions();
        //dd($questions);
        return view('nuovoQuestionario', ['questions' => $questions], ['idQuestionnaires' => $questionnaire->getData()->data]);
    }
    
    function mapQuestions($questions) {
        $groupedQuestions = $questions->sortBy('Tipo')->groupBy('Tipo');
    
        return $groupedQuestions->map(function ($types) {
            return $types->groupBy('Domanda')->map(function ($questions, $question) {
                return [
                    'idDomanda' => $questions->first()->idDomanda,
                    'domanda' => $question,
                    'risposte' => $questions->map(function ($question) {
                        return [
                            'idRisposta' => $question->idRisposta,
                            'risposta' => $question->Risposta
                        ];
                    })->toArray(),
                ];
            })->values()->toArray();
        })->toArray();
    }
    
    function getAllQuestions() {
        $questions = DB::table('questions')
            ->join('demands', 'questions.idDomanda', '=', 'demands.idDomanda')
            ->join('answers', 'questions.idRisposta', '=', 'answers.idRisposta')
            ->select('demands.Tipo', 'demands.Domanda', 'answers.Risposta', 'demands.idDomanda', 'answers.idRisposta')
            ->get();
    
        return $this->mapQuestions($questions);
    }
    
    function getQuestion($id) {
        try {
            $questions = DB::table('questions')
            ->join('demands', 'questions.idDomanda', '=', 'demands.idDomanda')
            ->join('answers', 'questions.idRisposta', '=', 'answers.idRisposta')
            ->select('questions.idQuesito', 'demands.Domanda', 'answers.Risposta')
            ->where('demands.idDomanda', $id)
            ->get();
            $question = mapQuestions($questions)->first();
            
            return response()->json(['success' => true, 'question' => $question]);
        } catch (\Exception $e) {
            return response()->json(['success' => true, 'error' => $e->getMessage()]);
        }
    }

    
    
    
    
    function deleteQuestion($id) {
        try {
            DB::table('demands')->where('idDomanda', $id)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

        
}

    

