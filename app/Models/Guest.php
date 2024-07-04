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

        for($i = 0; $i < $totalGuests; $i++){
            $guestArray = [];
            foreach($guestForm as $key => $value){
                if(gettype($value) == 'array'){
                    if($i < sizeof($value)) $guestArray[$key] = $value[$i];
                }
            }
            $guestsArray[] = $guestArray;
        }
        return $guestsArray;
    }
}
