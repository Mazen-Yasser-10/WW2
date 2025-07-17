<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserCashController extends Controller
{
    public function addFunds(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1|max:10000'
        ]);
        $user = User::find(Auth::id());
        $amount = (float) $request->amount;

        $user->cash = $user->cash  + $amount;
        $user->save();

        return redirect()->back()->with('success', 'War funds added successfully! +$' . number_format($amount, 2));
    }
}
