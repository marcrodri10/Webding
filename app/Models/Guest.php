<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'banquet',
        'home',
        'menu',
        'allergies',
        'song'
    ];

    public static function getTotalBanquets(){
        $total = Guest::select('banquet', DB::raw('COUNT(*) as cantidad'))
        ->groupBy('banquet')
        ->get();
        return $total;
    }
    public static function getTotalReturns(){
        $total = Guest::select('home', DB::raw('COUNT(*) as cantidad'))
        ->groupBy('home')
        ->get();
        return $total;
    }

    public static function getTotalMenus(){
        $total = Guest::select('menu', DB::raw('COUNT(*) as cantidad'))
        ->groupBy('menu')
        ->get();
        return $total;
    }

    public static function createGuestsArray($guestForm){
        $totalGuests = (int) $guestForm["totalGuests"];
        $guestsArray = [];

        foreach($guestForm as $formName => $array){
            if(gettype($array) == "array"){
                foreach($array as $key => $value){
                    if($formName == "menu"){
                        $guestsArray[$key][$formName] = $value["menu"];
                    }
                    else if($formName == "banquet"){
                        if($array[$key] == "0") $guestsArray[$key + 1][$formName] = "0";
                        else $guestsArray[$key + 1][$formName] = "1";
                    }
                    else if($formName == "home"){
                        if($array[$key] == "0") $guestsArray[$key + 1][$formName] = "No";
                        else $guestsArray[$key + 1][$formName] = $array[$key];
                    }
                    else $guestsArray[$key + 1][$formName] = $value;
                }
            }
            
        }
        return $guestsArray;
    }
}
