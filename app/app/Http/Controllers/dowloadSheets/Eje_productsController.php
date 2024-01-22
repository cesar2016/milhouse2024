<?php

namespace App\Http\Controllers\dowloadSheets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Eje_productsController extends Controller
{
    public function dowload_eje_products(){

        $name_file = 'model_productos.xlsx';
        $path = 'app/public/models_excel/';

        $pathToFile = storage_path($path.$name_file);
        return response()->download($pathToFile);

    }

}
