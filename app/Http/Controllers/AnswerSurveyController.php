<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerSurveyController extends Controller
{
    public function saveAnswer(request $request){
        try{
            $answer = DB::table('answers_survey')->select('idQuestionario', 'idDomanda', 'idRisposta')
            ->where('idQuestionario', $request->idQuestionario)
            ->where('idDomanda', $request->idDomanda)->get();

            if(count($answer) > 0){
                $answer = DB::table('answers_survey')->where('idQuestionario', $request->idQuestionario)
                ->where('idDomanda', $request->idDomanda)->update([
                    'idRisposta' => $request->idRisposta,
                ]);
                return response()->json(['success' => true, 'data' => $answer, 'message' => 'Risposta aggiornata con successo']);
            }else{
                $answer = DB::table('answers_survey')->insert([
                    'idQuestionario' => $request->idQuestionario,
                    'idDomanda' => $request->idDomanda,
                    'idRisposta' => $request->idRisposta,
                ]);
                //$answer = "ciao";
                return response()->json(['success' => true, 'data' => $answer, 'message' => 'Risposta salvata con successo']);
            }

        }catch(\Exception $e){
            return view('error', ['error' => $e->getMessage()]);
        }
    }

    public function calcoloFinale(request $Request){
        try{
            $answers = DB::table('answers_survey')->select('idQuestionario', 'idDomanda', 'idRisposta')
            ->where('idQuestionario', $Request->id)->get();

            $punteggioTipo1 = 0;
            $punteggioTipo2 = 0;
            $punteggioTipo3 = 0;

            foreach($answers as $answer){
                $question = DB::table('demands')->select('tipo')->where('idDomanda', $answer->idDomanda)->first();
                if($question->tipo == 1){
                    $punteggioTipo1 += DB::table('questions')->select('punteggio')->where('idRisposta', $answer->idRisposta)->first()->punteggio;
                }else if($question->tipo == 2){
                    $punteggioTipo2 += DB::table('questions')->select('punteggio')->where('idRisposta', $answer->idRisposta)->first()->punteggio;
                }else if($question->tipo == 3){
                    $punteggioTipo3 += DB::table('questions')->select('punteggio')->where('idRisposta', $answer->idRisposta)->first()->punteggio;
                }
            }

            
            $punteggiMax = $this->punteggioMassimo()->getData();
            //dd($punteggiMax->data);

            $punteggiMaxTot = (($punteggioTipo1 + $punteggioTipo2 + $punteggioTipo3) / $punteggiMax->data->total_max_score) * 100;
            //dd($punteggioTipo1,$punteggioTipo2,$punteggioTipo3,$punteggiMaxTot);
            //dd($punteggioTipo1, $punteggioTipo2, $punteggioTipo3, $punteggiMax->data->total_max_score, $punteggiMax->data->max_scores_per_type);
            foreach($punteggiMax->data->max_scores_per_type as $tipo => $max_score){
                if($tipo == 1){
                    $punteggioTipo1 = ($punteggioTipo1 / $max_score) * 100;
                }else if($tipo == 2){
                    $punteggioTipo2 = ($punteggioTipo2 / $max_score) * 100;
                }else if($tipo == 3){
                    $punteggioTipo3 = ($punteggioTipo3 / $max_score) * 100;
                }
            }

            //dd($punteggioTipo1, $punteggioTipo2, $punteggioTipo3);


            DB::table('questionnaires')->where('idQuestionario', $Request->id)
            ->update(['stato' => 2]);
            return view('risultati', ['punteggioTipo1' => $punteggioTipo1, 
            'punteggioTipo2' => $punteggioTipo2, 'punteggioTipo3' => $punteggioTipo3, 'punteggiMaxTot' => $punteggiMaxTot]);

        }catch(\Exception $e){
            return view('error', ['error' => $e->getMessage()]);
        }
    }


    public function punteggioMassimo(){
        try {
            $max_scores =  DB::table('questions')
                ->join('demands', 'questions.idDomanda', '=', 'demands.idDomanda')
                ->select('demands.tipo', 'questions.idDomanda', DB::raw('MAX(questions.Punteggio) AS massimo_valore'))
                ->groupBy('demands.tipo', 'questions.idDomanda')
                ->get();
    
            $total_max_score = 0;
            $max_scores_per_type = [];
    
            foreach ($max_scores as $max_score) {
                // Aggiungi il massimo punteggio di ogni domanda al totale
                $total_max_score += $max_score->massimo_valore;
                
                // Somma i massimi punteggi per ogni tipo di domanda
                if (!isset($max_scores_per_type[$max_score->tipo])) {
                    $max_scores_per_type[$max_score->tipo] = 0;
                }
                $max_scores_per_type[$max_score->tipo] += $max_score->massimo_valore;
            }

            return response()->json(['success' => true, 'data' => [
                'total_max_score' => $total_max_score,
                'max_scores_per_type' => $max_scores_per_type
            ]]);
    
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    
    
  
}
