<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRgenerator
{
    public function fromCsv(string $csvPath): string
    {
        
        $data = array_map('str_getcsv', file($csvPath));
        $headers = array_shift($data);

        $text = "";
        foreach ($data as $row) {
            $user = array_combine($headers, $row);
            for($i = 0; $i < count($headers); $i++) {
                 $text .= $headers[$i] . ": " . $user[$headers[$i]] . ' , ' ;
            }
            $text = substr($text, 0, -2) . "\n";
        }

        $qrImage = QrCode::format('png')->size(300)->generate($text);
        Storage::disk('public')->put('qrcode.png', $qrImage);
        return 'app/public/qrcode.png';
    }
}
