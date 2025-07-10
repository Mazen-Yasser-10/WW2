<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\MailMessage;
use App\Services\QRgenerator;

class QrCodeController extends Controller
{
    public function convertCsvToQr(QRgenerator $qrgenerator)
    {
        $path = storage_path('app/public/stock.csv');
        $qrCodeUrl = $qrgenerator->fromCsv($path);
        Mail::to('mazenmashal1011@gmail.com')->send(new MailMessage($qrCodeUrl));
        Storage::disk('public')->delete('qrcode.png');
        return "QR code generated and sent via email successfully!";
    }
}