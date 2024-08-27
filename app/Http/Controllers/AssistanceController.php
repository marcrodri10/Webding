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
    protected $spotifyService;

    public function __construct(SpotifyService $spotifyService)
    {
        $this->spotifyService = $spotifyService;
    }

    public function store(Request $request)
    {
        $guestsArray = Guest::createGuestsArray($request->all());
        $errorsArray = $this->validateGuests($guestsArray);

        if (!empty($errorsArray)) {
            return response()->json(['response' => ['error' => $errorsArray, 'status' => 404]]);
        }

        $emptyUriArray = [];

        foreach ($guestsArray as $index => $guest) {
            $guest['banquet'] = $request->has('banquet') ? 1 : 0;

            if (!empty($guest['song']) && !array_key_exists('uri', $guest)) {
                $emptyUriArray["song"] = [
                    "error" => 'Por favor, selecciona una canción de la lista inferior',
                    "guest" => $index,
                    "position" => array_search("song", array_keys($this->getValidationRules()))
                ];
            } elseif (array_key_exists('uri', $guest)) {
                try {
                    $responsePlaylist = $this->spotifyService->addSongToPlaylist($guest['uri']);
                    if ($responsePlaylist->getData()->status !== 200) {
                        return response()->json(['response' => ['error' => 'Error inesperado inténtelo más tarde', 'status' => 405]]);
                    }
                } catch (\Exception $e) {
                    return response()->json(['response' => ['error' => 'Error inesperado inténtelo más tarde', 'status' => 405]]);
                }
            }

            Guest::create($guest);
        }

        if (!empty($emptyUriArray)) {
            return response()->json(['response' => ['error' => [$emptyUriArray], 'status' => 404]]);
        }

        return response()->json(['response' => ['success' => 'Respuesta enviada con éxito', 'status' => 200]]);
    }

    private function validateGuests(array $guestsArray): array
    {
        $rules = $this->getValidationRules();
        $errorsArray = [];

        foreach ($guestsArray as $index => $guest) {
            $validator = Validator::make($guest, $rules, [
                'name.required' => 'Nombre es un campo obligatorio',
                'surname.required' => 'Apellido es un campo obligatorio',
                'menu.required' => 'Menú es un campo obligatorio',
            ]);

            if ($validator->fails()) {
                $errors = $validator->messages()->toArray();

                foreach ($errors as $field => $error) {
                    $errorsArray[] = [
                        $field => [
                            "error" => $error[0],
                            "position" => array_search($field, array_keys($rules)),
                            "guest" => $index,
                        ]
                    ];
                }
            }
        }

        return $errorsArray;
    }

    private function getValidationRules(): array
    {
        return [
            'name' => 'required|string',
            'surname' => 'required|string',
            'banquet' => 'string',
            'home' => 'string',
            'menu' => 'required|string',
            'allergies' => 'string|nullable',
            'song' => 'string|nullable',
        ];
    }
}

