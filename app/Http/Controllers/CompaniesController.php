<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends Controller
{
    function registrazione(Request $request){
        header('Access-Control-Allow-Origin: *');

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password2' => 'required|same:password',
            'ragioneSociale' => 'required|string|max:255',
            'partitaIva' => 'required|string|size:11|unique:companies,partitaIva',
            'codiceFiscale' => 'required|string|size:16|unique:companies,codiceFiscale',
            'indirizzo' => 'required|string|max:255',
            'citta' => 'required|string|max:255',
            'cap' => 'required|string|max:10',
            'provincia' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
        ]);
        
        if ($validator->fails()) {
            return view('error', ['error' => $validator->errors()->first()]);
        }

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

            return view('login', ['message' => 'Registrazione effettuata con successo, effettua il login per continuare' ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return view('error', ['error' => 'Errore durante la registrazione']);
        }
    }

    function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return view('error', ['error' => $validator->errors()->first()]);
        }

        $utente = DB::table('users')->where('email', $request->email)->first();
        
        if ($utente && password_verify($request->password, $utente->password)) {
            $sessionController = new SessionController;
            $sessionRequest = new Request;
            $sessionRequest->replace(['type' => 'Users', 'id' => $utente->idUtente]);
            $sessionController->CreateSession($sessionRequest);
            return view('home', ['message' => 'Login effettuato con successo', 'idUtente' => $utente->idUtente]);
        } else {
            return view('error', ['error' => 'Credenziali non valide']);
        }
    }

    function logout(Request $request){
        $sessionController = new SessionController;
        $sessionRequest = new Request;
        $sessionRequest->replace(['type' => 'Users']);
        $sessionController->destroySession($sessionRequest);
        
        return view('home', ['message' => 'Logout effettuato con successo']);
        /*if($request->session()->has('Users')){
            
        }else{
            return view('error', ['error' => 'Non sei loggato']);
        }*/
        
    }

}
