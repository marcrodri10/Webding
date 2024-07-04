<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

class SpotifyService
{
    protected $client;
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $this->client = new Client();
        $this->clientId = env('SPOTIFY_CLIENT_ID');
        $this->clientSecret = env('SPOTIFY_CLIENT_SECRET');
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
            dd($data);
            // Store tokens in session or database
            session(['access_token' => $data['access_token']]);
            session(['refresh_token' => $data['refresh_token']]);

            return response()->json([
                'access_token' => $data['access_token'],
                'refresh_token' => $data['refresh_token'],
            ]);
        }

        return response()->json(['error' => 'Unable to retrieve access token'], 400);
    }
    public function getClient()
    {
        return $this->client;
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
            Cache::put('spotify_access_token', $data['access_token']);
        }
        else {
            throw new \Exception('Could not retrieve access token from Spotify');
        }

    }

    public function addSongToPlaylist($uri)
    {
        try {
            $accessToken = Cache::get('spotify_access_token');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->post("https://api.spotify.com/v1/playlists/20VRo6xdWrkoEMRU9AcHsc/tracks", [
                'uris' => [$uri],
            ]);

            if ($response->successful()) {
                return response()->json(['response' => 'Datos enviados con éxito', 'status' => 200]);
            } else {
                return response()->json(['response' => $response->body(), 'status' => 404]); // Verifica el código de estado y el cuerpo de la respuesta en caso de error
            }

        } catch (\Exception $e) {

            return response()->json(['response' => $e->getMessage(), 'status' => 404]);
        }
    }

}
