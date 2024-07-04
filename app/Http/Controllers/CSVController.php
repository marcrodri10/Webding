<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use League\Csv\Reader;
use League\Csv\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CSVController extends Controller
{
    //
    public function download()
    {
        // Obtiene los datos que deseas exportar a CSV, por ejemplo:
        $data = Guest::all(); // Reemplaza YourModel con tu modelo real

        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->setOutputBOM(Reader::BOM_UTF8);
        $csv->setDelimiter(';');
        $csv->insertOne(['Nombre', 'Apellidos', 'Traslado al banquete', 'Traslado a casa', 'Menú', 'Alergias', 'Canción']);

        foreach ($data as $person) {
            $info = $person->only('name', 'surname', 'banquet', 'home', 'menu', 'allergies', 'song');
            $info['banquet'] = $info['banquet'] == 0 ? 'No' : 'Sí';
            $csv->insertOne($info);
        }
        $totalBanquets = Guest::getTotalBanquets();
        $totalReturns = Guest::getTotalReturns();
        $totalMenus = Guest::getTotalMenus();

        $csv->insertOne(['']);
        $csv->insertOne(['']);

        foreach($totalBanquets as $total){
            $total->banquet == 0 ? $csv->insertOne(['Total personas que no quieren traslado al banquete', $total->cantidad])
            : $csv->insertOne(['Total personas que quieren traslado al banquete', $total->cantidad]);
        }
        $csv->insertOne(['']);
        $csv->insertOne(['']);
        foreach($totalReturns as $total){
            if($total->home == 'No') $csv->insertOne(['Total personas que no quieren vuelta a casa', $total->cantidad]);
            else $csv->insertOne(['Total personas que no quieren vuelta a casa ( '.$total->home .' )', $total->cantidad]);
        }
        $csv->insertOne(['']);
        $csv->insertOne(['']);
        foreach($totalMenus as $total){
            $csv->insertOne(['Total personas que han elegido la opción de menú ( '.$total->menu .' )', $total->cantidad]);
        }
        $csv->output('webding.csv');

    }
}
