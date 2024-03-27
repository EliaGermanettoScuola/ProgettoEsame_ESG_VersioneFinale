<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompaniesController extends Controller
{
    function registrazione(Request $request){
        header('Access-Control-Allow-Origin: *');

        DB::beginTransaction();

        try {
            $idUtente = DB::table('users')->insertGetId([
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            DB::table('companies')->insert([
                'ragioneSociale' => $request->ragioneSociale,
                'partitaIva' => $request->partitaIva,
                'codiceFiscale' => $request->codiceFiscale,
                'indirizzo' =>  $request->indirizzo,
                'citta' => $request->citta,
                'cap' =>  $request->cap,
                'provincia' => $request->provincia,
                'telefono' => $request->telefono,
                'idUtente' => $idUtente,
            ]);

            DB::commit();

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['status' => 'ko', 'error' => $e->getMessage()]);
        }
    }

    function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $utente = DB::table('users')->where('email', $request->email)->first();
        
        if ($utente && password_verify($request->password, $utente->password)) {
            return response()->json(['success' => true,'message'=>'messaggio avvenuto con successo', 'idUtente' => $utente->idUtente]);
        } else {
            return response()->json(['success' => false, 'error' => 'Credenziali non valide']);
        }
    }
}
