<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\PaymentMethod;
use App\Models\Ticket;


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

    public function transactionReceipt(Transaction $transaction)
    {
        $user = Auth::user();
        // Get payment details
        $payment = PaymentMethod::find($transaction->payment_method_id);

        // Get associated tickets
        $tickets = Ticket::where('transaction_id', $transaction->id)->get();

        // Return the data to the 'user.receipt' view
        return view('user.receipt', [
            'payment' => $payment,
            'tickets' => $tickets,
            'transaction' => $transaction,
            'user' => $user,
        ]);
    }

    public function ticket()
    {
        $user = Auth::user();

        $result = DB::table('transactions')
            ->join('tickets', 'transactions.id', '=', 'tickets.transaction_id')
            ->join('catagories', 'tickets.catagory_id', '=', 'catagories.id')
            ->join('concert_details', 'catagories.concert_detail_id', '=', 'concert_details.id')
            ->join('venues', 'catagories.venue_id', '=', 'venues.id')
            ->join('concerts', 'concert_details.concert_id', '=', 'concerts.id')
            ->select('tickets.tcode', 'concerts.name as concert_name', 'concert_details.date', 'venues.name as venue_name')
            ->where('transactions.user_id', 2)
            ->get();

        return view('user.ticket', [
            'tickets' => $result,
        ]);
    }
}
