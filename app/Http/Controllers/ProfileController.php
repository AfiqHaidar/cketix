<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\Transaction;
use App\Models\PaymentMethod;
use App\Models\Ticket;
use App\Models\Concert;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function transactionHistory()
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)->get();

        return view('profile.transaction', [
            'transactions' => $transactions,
        ]);
    }

    public function transactionReceipt(Transaction $transaction)
    {
        $user = Auth::user();
        // Get payment details
        $payment = PaymentMethod::find($transaction->payment_method_id);

        $details = DB::table('transactions')
            ->join('tickets', 'transactions.id', '=', 'tickets.transaction_id')
            ->join('catagories', 'tickets.catagory_id', '=', 'catagories.id')
            ->join('concert_details', 'catagories.concert_detail_id', '=', 'concert_details.id')
            ->join('concerts', 'concert_details.concert_id', '=', 'concerts.id')
            ->select(
                DB::raw('count(tickets.tcode) as ticket_count'),
                'concerts.name',
                'catagories.price',
                'catagories.code',
                'concert_details.date'
            )
            ->where('transactions.id', $transaction->id)
            ->groupBy(
                'transactions.id',
                'concerts.name',  // Include non-aggregated column in GROUP BY
                'catagories.price',
                'catagories.code',
                'concert_details.date'
            )
            ->get();

        // dd($details[0]);

        // Return the data to the 'user.receipt' view
        return view('profile.receipt', [
            'payment' => $payment,
            'details' => $details[0],
            'transaction' => $transaction,
            'user' => $user,
        ]);
    }

    public function ticket()
    {
        $user = Auth::user();

        $concerts = DB::table('transactions')
            ->join('tickets', 'transactions.id', '=', 'tickets.transaction_id')
            ->join('catagories', 'tickets.catagory_id', '=', 'catagories.id')
            ->join('concert_details', 'catagories.concert_detail_id', '=', 'concert_details.id')
            ->join('venues', 'catagories.venue_id', '=', 'venues.id')
            ->join('concerts', 'concert_details.concert_id', '=', 'concerts.id')
            ->select('concerts.id as id', 'concerts.name as name', 'concerts.image as image')
            ->distinct()
            ->where('transactions.user_id', $user->id)
            ->get();

        $result = DB::table('transactions')
            ->join('tickets', 'transactions.id', '=', 'tickets.transaction_id')
            ->join('catagories', 'tickets.catagory_id', '=', 'catagories.id')
            ->join('concert_details', 'catagories.concert_detail_id', '=', 'concert_details.id')
            ->join('venues', 'catagories.venue_id', '=', 'venues.id')
            ->join('concerts', 'concert_details.concert_id', '=', 'concerts.id')
            ->select('tickets.tcode', 'concerts.name as concert_name', 'concerts.image as concert_image', 'concert_details.date', 'venues.name as venue_name')
            ->where('transactions.user_id', $user->id)
            ->get();

        return view('profile.ticket', [
            'concerts' => $concerts,
            'tickets' => $result,
        ]);
    }
}
