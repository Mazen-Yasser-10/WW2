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

        $text = "CSV Users:\n";
        foreach ($data as $row) {
            $user = array_combine($headers, $row);
            $text .= "Name: {$user['name']}, Email: {$user['email']}\n";
        }

        $qrImage = QrCode::format('png')->size(300)->generate($text);
        Storage::disk('public')->put('qrcode.png', $qrImage);
        $filename = 'app/public/qrcode.png';
        return $filename;
    }
}
