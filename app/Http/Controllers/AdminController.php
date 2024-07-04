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
        return view('auth.login');
    }

    public function auth(Request $request){
        $credentials = $request->only('username', 'password');
        if(!Auth::attempt($credentials)){
            throw ValidationException::withMessages([
                'username' => trans('auth.failed'),
            ]);
        }
        else {
            return redirect()->route('admin.index');
        }
    }

    public function admin(){
        $guestsInfo = Guest::all();
        return view('admin', ['guestsInfo' => $guestsInfo]);
    }
}
