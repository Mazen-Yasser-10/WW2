<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\MailMessage;
use App\Services\QRgenerator;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function convertCsvToQr(Request $request, QRgenerator $qrgenerator)
    {
        $path = storage_path('app/public/stock.csv');
        $qrCodeUrl = $qrgenerator->fromCsv($path);
        Mail::to($request->email)->send(new MailMessage($qrCodeUrl));
        Storage::disk('public')->delete('qrcode.png');
        return "QR code generated and sent via email successfully!";
    }
}