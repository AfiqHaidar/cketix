<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\ConcertDetail;
use App\Models\PaymentMethod;

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
        dd($request->ticket);
    }
}
