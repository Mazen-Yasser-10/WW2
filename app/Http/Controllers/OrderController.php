<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\WeaponListing;
use App\Models\Country;
use App\Models\User;
use App\Mail\OrderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $currencyConverter = app('CurrencyConverter');
        $selectedCountry = $user->country->name;
        
        $orders = Order::with(['cart.user', 'weaponListing.weapon.weaponType', 'weaponListing.weapon.country'])
            ->latest()
            ->get();

        foreach ($orders as $order) {
            $order->local_price = $currencyConverter->convertWithSymbol($order->total_price, $selectedCountry);
            $order->unit_local_price = $currencyConverter->convertWithSymbol($order->weaponListing->price, $selectedCountry);
        }

        return view('orders.index', compact('orders', 'selectedCountry'));
    }
    public function showByUser()
    {
        $user = Auth::user();
        $selectedCountryName = $user->country ? $user->country->name : 'Germany';
        $currencyConverter = app('CurrencyConverter');
        
        $orders = Order::whereHas('cart', function ($query) {
            $query->where('user_id', Auth::id());
        })->with(['weaponListing.weapon.weaponType', 'weaponListing.weapon.country'])
            ->latest()
            ->get();

        return view('orders.user_orders', compact('orders', 'selectedCountryName', 'currencyConverter'));
    }
    
    public function showSendOrderForm()
    {
        $users = User::with('country')->where('id', '!=', Auth::id())->get();
        return view('orders.send-order', compact('users'));
    }
    
    public function sendOrderEmail(Request $request)
    {
        $request->validate([
            'recipient_user_id' => 'required|exists:users,id',
            'recipient_email' => 'required|email',
            'subject' => 'required|string|max:255',
            'weapons_list' => 'required|string',
            'cash_amount' => 'required|numeric|min:0',
            'transfer_purpose' => 'required|string',
            'message_body' => 'nullable|string'
        ]);

        $sender = User::findOrFail(Auth::id());
        $recipient = User::findOrFail($request->recipient_user_id);
        
        if ($sender->cash < $request->cash_amount) {
            return back()->withErrors(['cash_amount' => 'Insufficient funds. Your current balance is $' . number_format($sender->cash, 2)])->withInput();
        }

        $sender->cash -= $request->cash_amount;
        $recipient->cash += $request->cash_amount;

        $sender->save();
        $recipient->save();
        
        $emailData = [
            'sender_name' => $sender->name,
            'sender_role' => ucfirst($sender->role),
            'sender_country' => $sender->country->name ?? 'Unknown',
            'recipient_name' => $recipient->name,
            'subject' => $request->subject,
            'weapons_list' => $request->weapons_list,
            'cash_amount' => $request->cash_amount,
            'transfer_purpose' => str_replace('_', ' ', ucfirst($request->transfer_purpose)),
            'message_body' => $request->message_body,
            'order_date' => now()->format('Y-m-d H:i:s')
        ];
        
        try {
            Mail::to($recipient->email)->send(new OrderMail($emailData));
            return redirect()->route('weapons.index')->with('success','Order sent successfully! $' . number_format($request->cash_amount, 2) . ' has been transferred to ' . $recipient->name);
        } catch (\Exception $e) {
            $sender->cash += $request->cash_amount;
            $recipient->cash -= $request->cash_amount;
            $sender->save();
            $recipient->save();
            
            return back()->withErrors(['error' => 'Failed to send email. Please try again.'])->withInput();
        }
    }
}
