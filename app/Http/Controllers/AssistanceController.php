<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use App\Services\SpotifyService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class AssistanceController extends Controller
{
    //
    protected $spotifyService;

    public function __construct(SpotifyService $spotifyService)
    {
        $this->spotifyService = $spotifyService;
    }
    public function store(Request $request)
    {
        $formResults = $request->all();
        $guestsArray = Guest::createGuestsArray($formResults);

        foreach($guestsArray as $guest){
            $validator = Validator::make($guest, [
                'name' => 'required|string',
                'surname' => 'required|string',
                'banquet' => 'string',
                'home' => 'string',
                'menu' => 'required|string',
                'allergies' => 'string|nullable',
                'song' => 'string|nullable',
            ]);
            if ($validator->fails()) {
                $errors = $validator->messages();
                dd($errors, $guest);
                return response()->json(['response' => 'Ha habido un error inesperado: ', 'status' => 404]);
            }
        }


        $data = $guestsArray;
        foreach($data as $key => $value){
            $data[$key]['banquet'] = $request->has('banquet') ? 1 : 0;

            Guest::create($data[$key]);

            if($data[$key]["uri"]){
                try{
                    $responsePlaylist = $this->spotifyService->addSongToPlaylist($data[$key]["uri"]);
                    if($responsePlaylist->getData()->status !== 200){
                        return response()->json(['response' => 'Error inesperado inténtelo más tarde', 'status' => 404]);
                    }
                }
                catch(\Exception $e){
                    throw new \Exception("Error inesperado inténtelo más tarde");
                }

            }

        }
        return response()->json(['response' => 'Respuesta enviada con éxito', 'status' => 200]);




    }


}
