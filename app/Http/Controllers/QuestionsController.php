<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    function getAllQuestions() {

        try {
            $questions = DB::table('questions')
            ->join('demands', 'questions.idDomanda', '=', 'demands.idDomanda')
            ->join('answers', 'questions.idRisposta', '=', 'answers.idRisposta')
            ->select('questions.idQuesito', 'demands.Domanda', 'answers.Risposta')
            ->get();

            $questions = $this->mapQuestions($questions)->values();
            return response()->json(['success' => true, 'questions' => $questions]);
        } catch (\Exception $e) {
            return response()->json(['success' => true, 'error' => $e->getMessage()]);
        }
        
    }

    function getQuestion($id) {
        try {
            $questions = DB::table('questions')
            ->join('demands', 'questions.idDomanda', '=', 'demands.idDomanda')
            ->join('answers', 'questions.idRisposta', '=', 'answers.idRisposta')
            ->select('questions.idQuesito', 'demands.Domanda', 'answers.Risposta')
            ->where('demands.idDomanda', $id)
            ->get();
            $question = $this->mapQuestions($questions)->first();
            
            return response()->json(['success' => true, 'question' => $question]);
        } catch (\Exception $e) {
            return response()->json(['success' => true, 'error' => $e->getMessage()]);
        }
    }

    private function mapQuestions($questions) {
        $groupedQuestions = $questions->groupBy('Domanda');

        return $groupedQuestions->map(function ($group, $question) {
            return [
                'id' => $group->first()->idQuesito,
                'domanda' => $question,
                'risposte' => $group->pluck('Risposta'),
            ];
        });
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
