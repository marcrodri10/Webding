<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SpotifyService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SpotifyController extends Controller
{
    protected $spotifyService;

    public function __construct(SpotifyService $spotifyService)
    {
        $this->spotifyService = $spotifyService;
    }
    public function redirectToSpotify()
    {
        $query = http_build_query([
            'client_id' => env('SPOTIFY_CLIENT_ID'),
            'response_type' => 'code',
            'redirect_uri' => env('SPOTIFY_REDIRECT_URI'),
            'scope' => env('SPOTIFY_SCOPES'),
        ]);

        return redirect('https://accounts.spotify.com/authorize?' . $query);
    }

    public function handleSpotifyCallback(Request $request)
    {
        $code = $request->query('code');
        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => env('SPOTIFY_REDIRECT_URI'),
            'client_id' => env('SPOTIFY_CLIENT_ID'),
            'client_secret' => env('SPOTIFY_CLIENT_SECRET'),
        ]);

        if ($response->successful()) {
            $data = $response->json();
            // Guardar tokens en la sesión o en la base de datos
            session(['access_token' => $data['access_token']]);
            session(['refresh_token' => $data['refresh_token']]);
            Cache::put('spotify_access_token', $data['access_token']);
            Cache::put('spotify_refresh_token', $data['refresh_token'], now()->addMinutes(5));

            return redirect()->route('index');
        }

        return response()->json(['error' => 'No se pudo obtener el token de acceso'], 400);
    }

    public function getSpotifyAccessToken(){

        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => env('SPOTIFY_REFRESH_TOKEN'),
            'client_id' => env('SPOTIFY_CLIENT_ID'),
            'client_secret' => env('SPOTIFY_CLIENT_SECRET'),
        ]);

        $data = $response->json();

        if (isset($data['access_token'])) {
            Cache::put('spotify_access_token', $data['access_token'], now()->addMinutes(55));
        }

        throw new \Exception('Could not retrieve access token from Spotify');
    }
    public function getSongs(Request $request)
    {
        $inputValue = $request->song;
        $accessToken = Cache::get('spotify_access_token');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get('https://api.spotify.com/v1/search?q='.$inputValue.'&type=track&limit=6');

        return response()->json(json_decode($response->getBody(), true));
    }


}
