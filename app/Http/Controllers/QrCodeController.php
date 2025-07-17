<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\MailMessage;
use App\Services\QRgenerator;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function convertCsvToQr(Request $request, $filename,QRgenerator $qrgenerator)
    {
        $path = storage_path('app/public/orders/' . $filename);
        $qrCodeUrl = $qrgenerator->fromCsv($path);
        Mail::to($request->email)->send(new MailMessage($qrCodeUrl));
        Storage::disk('public')->delete('qrcode.png');
        return redirect()->back()->with('success', 'QR Code sent to your email successfully.');
    }
}