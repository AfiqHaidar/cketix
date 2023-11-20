<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Transaction;


class UserController extends Controller
{
    public function transactionHistory()
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)->get();

        return view('user.purchased', [
            'transactions' => $transactions,
        ]);
    }
}
