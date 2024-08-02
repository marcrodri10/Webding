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
        $rules = [
            'name' => 'required|string',
            'surname' => 'required|string',
            'banquet' => 'string',
            'home' => 'string',
            'menu' => 'required|string',
            'allergies' => 'string|nullable',
            'song' => 'string|nullable',
        ];
        $guestIndex = 0;
        $errorsArray = [];
        foreach($guestsArray as $guest){
            $validator = Validator::make($guest, $rules, [
                "name.required" => 'Nombre es un campo obligatorio',
                "surname.required" => 'Apellido es un campo obligatorio',
                "menu.required" => 'Menú es un campo obligatorio',
            ]);
            if ($validator->fails()) {
                $errors = $validator->messages()->toArray();

                foreach($errors as $name => $error){
                    $errors[$name] = [];
                    $errors[$name]["error"] = $error[0];
                    $position = array_search($name, array_keys($rules));
                    $errors[$name]["position"] = $position;
                    $errors[$name]["guest"] = $guestIndex;

                }
                $errorsArray[] = $errors;
                //return response()->json(['response' => ["error" => $errors], 'status' => 404]);
            }
            $guestIndex++;
        }
        if(sizeof($errorsArray) > 0) return response()->json(['response' => ["error" => $errorsArray, 'status' => 404]]);


        $data = $guestsArray;
        $emptyUriArray = [];
        foreach($data as $key => $value){
            $data[$key]['banquet'] = $request->has('banquet') ? 1 : 0;

            if($data[$key]['song'] !== null && !array_key_exists("uri", $data[$key])) {
                $emptyUriArray["song"]["error"] =  'Por favor, selecciona una canción de la lista inferior';
                $emptyUriArray["song"]["guest"] = $key;
                $emptyUriArray["song"]["position"] = array_search("song", array_keys($rules));

            }
            else if(array_key_exists("uri", $data[$key])){
                try{
                    $responsePlaylist = $this->spotifyService->addSongToPlaylist($data[$key]["uri"]);
                    if($responsePlaylist->getData()->status !== 200){

                        return response()->json(['response' => ["error" => 'Error inesperado inténtelo más tarde', 'status' => 405]]);
                    }
                }
                catch(\Exception $e){
                    return response()->json(['response' => ["error" => 'Error inesperado inténtelo más tarde', 'status' => 405]]);
                }

            }
            else Guest::create($data[$key]);

        }
        if(sizeof($emptyUriArray) > 0) return response()->json(['response' => ["error" => [$emptyUriArray], 'status' => 404]]);

        return response()->json(['response' => ["success" => 'Respuesta enviada con éxito', 'status' => 200]]);




    }


}
