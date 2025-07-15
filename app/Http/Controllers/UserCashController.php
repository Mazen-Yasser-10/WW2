<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserCashController extends Controller
{
    /**
     * Add funds to user's cash balance
     */
    public function addFunds(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1|max:10000'
        ]);
        $user = Auth::user();
        $amount = (float) $request->amount;

        // Ensure $user is an instance of the User Eloquent model
        if (!$user instanceof \App\Models\User) {
            $user = User::find($user->id);
        }

        $user->cash = ($user->cash ?? 0) + $amount;
        $user->save();

        return redirect()->back()->with('success', 'War funds added successfully! +$' . number_format($amount, 2));
    }
    
    /**
     * Deduct funds from user's cash balance
     */
    public function deductFunds(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01'
        ]);

        $user = Auth::user();
        $amount = (float) $request->amount;

        // Ensure $user is an instance of the User Eloquent model
        if (!$user instanceof \App\Models\User) {
            $user = User::find($user->id);
        }

        if (($user->cash ?? 0) >= $amount) {
            $user->cash = ($user->cash ?? 0) - $amount;
            $user->save();
            $user->refresh();
            return response()->json([
                'success' => true,
                'message' => 'Funds deducted successfully',
                'new_balance' => '$' . number_format($user->cash ?? 0, 2)
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Insufficient funds'
        ], 400);
    }
    
    /**
     * Get current user balance
     */
    public function getBalance()
    {
        $user = Auth::user();
        return response()->json([
            'balance' => $user->cash ?? 0,
            'formatted_balance' => '$' . number_format($user->cash ?? 0, 2)
        ]);
    }
}
