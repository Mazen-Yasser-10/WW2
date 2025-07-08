<?php 

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRgenerator
{
    public function fromCsv(string $csvPath): array
    {
        $data = array_map('str_getcsv', file($csvPath));
        $headers = array_shift($data);

        $qrCodes = [];

        foreach ($data as $row) {
            $user = array_combine($headers, $row);

            $text = "Name: {$user['name']}, Email: {$user['email']}";
            $qrImage = QrCode::format('svg')->size(200)->generate($text);
            $base64 = 'data:image/svg+xml;base64,' . base64_encode($qrImage);

            $qrCodes[] = [
                'user' => $user,
                'qr' => $base64
            ];
        }

        return $qrCodes;
    }
}