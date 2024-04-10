<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SessionController;
use Carbon\Carbon;

class QuestionnairesController extends Controller
{


    public function createSurvey(Request $request){
        $request->validate([
            'idUtente' => 'required',
            'stato' => 'required',
        ]);
        try{
            $idQuestionnaires = DB::table('questionnaires')->insertGetId([
                'idUtente' => $request->idUtente,
                'stato' => $request->stato,
                'dataInizio' => Carbon::now(),
                'dataUltimoAggiornamento' => Carbon::now(),
            ]);
            return response()->json(['success' => true, 'data' => $idQuestionnaires, 'message' => 'Questionario created con successo']);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getUserSurvey(Request $request){
        try{
            $questionnaires = DB::table('questionnaires')->where('idUtente', $request->id)->get();
            return response()->json(['success' => true, 'data' => $questionnaires]);
        }catch(\Exception $e){
            return view('error', ['error' => $e->getMessage()]);
        }
    }

    public function getSurvey(Request $request){
        try{
            $questionnaires = DB::table('questionnaires')->where('idQuestionario', $request->id)->get();
            return response()->json(['success' => true, 'data' => $questionnaires]);
        }catch(\Exception $e){
            return view('error', ['error' => $e->getMessage()]);
        }
    }

    public function destroySurvey(Request $request){
        try{
            $questionnaires = DB::table('questionnaires')->where('idQuestionario', $request->id)->delete();
            return response()->json(['success' => true, 'data' => $questionnaires, 'message' => 'Questionario eliminato con successo']);
        }catch(\Exception $e){
            return view('error', ['error' => $e->getMessage()]);
        }
    }
}
