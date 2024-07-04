<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SpotifyService;

class RenewSpotifyToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'renew-spotify-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Renueva el token de acceso de Spotify';
    protected $spotifyService;
    public function __construct(SpotifyService $spotifyService)
    {
        parent::__construct();
        $this->spotifyService = $spotifyService;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->spotifyService->getAccessToken();
        $this->info('Token de acceso de Spotify renovado con éxito.');
    }
}
