<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\QuestionnairesController;


class QuestionsController extends Controller
{
    function questionario() {
        if(!session()->has('Users')){
            return view('login', ['error' => 'Devi effettuare il login per accedere a i questionari']);
        }else{
            $sessionController = new SessionController;
            $sessionRequest = new Request;
            $sessionRequest->replace(['type' => 'Users']);
            $session = $sessionController->getSession($sessionRequest);
            if($session->getData()->success == false){
                return view('error', ['error' => $session->getData()->message]);
            }
            $questionnairesController = new QuestionnairesController;
            $questionnairesRequest = new Request;
            $questionnairesRequest->replace(['idUtente' => $session->getData()->data->Users]);
            $questionnaires = $questionnairesController->getUserSurvey($questionnairesRequest);
            if($questionnaires->getData()->success == false){
                return view('error', ['error' => $questionnaires->getData()->message]);
            }
            return view('questionario', ['questionnaires' => $questionnaires->getData()->data]);
        }
    }

    function nuovoQuestionario() {
        $userAnswers = null;
        $sessionController = new SessionController;
        $sessionRequest = new Request;
        $sessionRequest->replace(['type' => 'Users']);
        $session = $sessionController->getSession($sessionRequest);
        if($session->getData()->success == false){
            return view('login', ['error' => "Effettua il login per accedere a questa sezione"]);
        }
        $questionnairesController = new QuestionnairesController;
        $questionnairesRequest = new Request;
        $questionnairesRequest->replace(['idUtente' => $session->getData()->data->Users, 'stato' => '1']);
        
        $questionnaires = $questionnairesController->getUserSurvey($questionnairesRequest);
        if($questionnaires->getData()->success == false){
            return view('error', ['error' => $questionnaires->getData()->message]);
        }
        foreach($questionnaires->getData()->data as $questionnaire){
            if($questionnaire->stato == 1){
                $userAnswers = $this->creaQuestionarioIniziato($questionnaire);
                $idQuestionnaire = $questionnaire->idQuestionario;
                break;
            }
        }
        
        if($userAnswers == null){
            $questionnaire = $questionnairesController->createSurvey($questionnairesRequest);
            $idQuestionnaire = $questionnaire->getData()->data;
            if($questionnaire->getData()->success == false){
                return view('error', ['error' => $questionnaire->getData()->error]);
            }
        }
        
        
        $questions = $this->getAllQuestions();

        if($userAnswers != null && $userAnswers != "1"){
            foreach($questions as $questionTypeKey => $questionType){
                foreach($questionType as $questionKey => $question){
                    for($i = 0; $i < count($userAnswers); $i++){
                        if($question['idDomanda'] == $userAnswers[$i]['idDomanda']){
                            $questions[$questionTypeKey][$questionKey]['rispostaData'] = $userAnswers[$i]['idRispostaData'];
                        }
                    }
                }
            }
        }
        
        return view('nuovoQuestionario', ['questions' => $questions], ['idQuestionnaires' => $idQuestionnaire]);
    }
    
    function creaQuestionarioIniziato($questionnaire){
        $questions = DB::table('answers_survey')
        ->where('idQuestionario', $questionnaire->idQuestionario)
        ->get();
        $questionIds = $questions->pluck('idDomanda');
        $answerIds = $questions->pluck('idRisposta');

        $questions = DB::table('questions')
            ->join('demands', 'questions.idDomanda', '=', 'demands.idDomanda')
            ->join('answers', 'questions.idRisposta', '=', 'answers.idRisposta')
            ->select('demands.Tipo', 'demands.Domanda', 'answers.Risposta', 'demands.idDomanda', 'answers.idRisposta')
            ->whereIn('questions.idDomanda', $questionIds)
            
            ->get();
        

        $userAnswers = array_combine($questionIds->toArray(), $answerIds->toArray());
        $userAnswers = collect($userAnswers)->map(function ($value, $key) {
            return ['idDomanda' => $key, 'idRispostaData' => $value];
        })->values()->all();

        if($userAnswers == null)
            $userAnswers = "1";

        return $userAnswers;
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
    
    function deleteQuestion($id) {
        try {
            DB::table('demands')->where('idDomanda', $id)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

        
}

    

