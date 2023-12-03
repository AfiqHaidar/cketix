<?php

namespace App\Http\Controllers;

use App\Jobs\SendTicketMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Catagory;
use App\Models\ConcertDetail;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use App\Models\Ticket;

class TransactionController extends Controller
{
    public function index(ConcertDetail $detail, Request $request)
    {
        $catagory = Catagory::where('concert_detail_id', $detail->id)->get();
        $payment = PaymentMethod::all();
        return view('concert.transaction', [
            'catagories' => $catagory,
            'ticket' => $request->ticket,
            'payment' => $payment,
            'detail' => $detail,
        ]);
    }

    public function store(ConcertDetail $detail, Catagory $category, Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Calculate the total price
        $totalPrice = $category->price * $request->ticket;

        $transaction = Transaction::create([
            'date' => now(),
            'total' => $totalPrice,
            'user_id' => $user->id,
            'payment_method_id' => $request->input('payment-method'),
        ]);


        for ($i = 0; $i < $request->input('ticket'); $i++) {
            // Format the ticket code
            $ticketCode = $category->code . str_pad($category->seat, 3, '0', STR_PAD_LEFT);

            // Create a new ticket
            $ticket = new Ticket([
                'tcode' => $ticketCode,
                'catagory_id' => $category->id,
                'transaction_id' => $transaction->id,
            ]);


            // Save the ticket to the database
            $ticket->save();

            // Decrement the category seat in the database
            $category->decrement('seat');
        }

        // mail handling
        $userMailData = $user;
        $transactionMailData = $transaction;
        $ticketMailData =  $request->input('ticket');
        $catMailData = $category;

        dispatch(new SendTicketMail($ticketMailData, $transactionMailData, $catMailData, $userMailData));

        return redirect()->route('profile.receipt', ['transaction' => $transaction]);
    }
}
