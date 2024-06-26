<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function getSession(Request $request){
        
        $request->validate([
            'type' => 'required',
        ]);

        try {
            if (Session::has($request->type)) {
                return response()->json(['success' => true, 'data' => Session::all()]);
            } else {
                return response()->json(['success' => false, 'message' => 'No data in the session']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function CreateSession(Request $request){

        $request->validate([
            'id' => 'required',
            'type' => 'required'
        ]);

        Session::put($request->type, $request->id);
        return response()->json(['status' => 'success', 'data' => Session::get($request->type)]);
    }

    public function destroySession(Request $request){

        $request->validate([
            'type' => 'required'
        ]);

        if(Session::has($request->type)){
            Session::forget($request->type);
            return response()->json(['success' => true, 'message' => 'Session data deleted successfully']);
        }else{
            return response()->json(['success' => true, 'message' => 'No data in the session to delete']);
        }
        
    }

    public function getSessionInfo(Request $request){
        $sessionData = $request->session()->all();
        return response()->json(['sessionData' => $sessionData]);
    }
}
