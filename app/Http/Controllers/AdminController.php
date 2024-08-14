<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    //
    public function index(){
        if(Auth::user()) return $this->admin();
        return view('auth.login');
    }

    public function auth(Request $request){
        $credentials = $request->only('username', 'password');

        if(!Auth::attempt($credentials)){
            return response()->json(["response" => ["error" => "El usuario o contraseña son incorrectos", "status" => 404]]);
        }
        else {
            return response()->json(["response" => ["success" => "OK", "status" => 200]]);;
        }
    }

    public function admin(){
        $guestsInfo = Guest::all();
        return view('admin', ['guestsInfo' => $guestsInfo]);
    }
}
