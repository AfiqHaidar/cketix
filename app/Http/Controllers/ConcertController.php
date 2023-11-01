<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Concert;
use App\Models\ConcertDetail;

class ConcertController extends Controller
{
    public function index()
    {
        $concert = Concert::all();

        return view('concert.index', [
            'concerts' => $concert,
        ]);
    }

    public function show(Concert $concert)
    {
        $details = ConcertDetail::where('concert_id', $concert->id)->get();

        $guest = DB::table('guest_details')
            ->join('guests', 'guest_details.guest_id', '=', 'guests.id')
            ->where('guest_details.concert_id', $concert->id)
            ->select('guest_details.*', 'guests.name as guest_name')
            ->get();

        return view('Concert/Detail', [
            'concert' => $concert->name,
            'concertDetails' => $details,
            'guestDetails' => $guest,
        ]);
    }
}
