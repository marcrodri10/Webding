<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    //
    public function download(){
        $guestsInfo = Guest::all();
        $totalBanquets = Guest::getTotalBanquets();
        $totalReturns = Guest::getTotalReturns();
        $totalMenus = Guest::getTotalMenus();
        $pdf = Pdf::loadView('pdf', ['guestsInfo' => $guestsInfo, 'totalBanquets' => $totalBanquets,
        'totalReturns' => $totalReturns, 'totalMenus' => $totalMenus]);
        return $pdf->download('webding.pdf');

    }
}
