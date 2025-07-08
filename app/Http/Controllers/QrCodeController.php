<?php

namespace App\Http\Controllers;

use App\Services\QRgenerator;

class QrCodeController extends Controller
{
    public function convertCsvToQr(QRgenerator $qrgenerator)
    {
        $path = storage_path('app/public/stock.csv');
        $qrCodes = $qrgenerator->fromCsv($path);

        return view('qr.bulk', compact('qrCodes'));
    }
}
