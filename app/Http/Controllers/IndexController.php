<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SpotifyService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class IndexController extends Controller
{
    //
    protected $spotifyService;

    public function __construct(SpotifyService $spotifyService)
    {
        $this->spotifyService = $spotifyService;
    }
    public function index(){
        $date = Config::get('constants.WEDDING_DATE');
        $this->spotifyService->getSpotifyAccessToken();

        return view('index', ["date" => $date]);
    }
}
