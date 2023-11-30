<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Banner;
use App\Models\Concert;
use App\Models\ConcertDetail;
use App\Models\Guest;

class ConcertController extends Controller
{
    public function dashboard()
    {
        $banners = $this->getBanners();

        return view('dashboard', [
            'banners' => $banners,
        ]);
    }

    private function getTopConcerts()
    {
        return DB::table('transactions')
            ->join('tickets', 'transactions.id', '=', 'tickets.transaction_id')
            ->join('catagories', 'tickets.catagory_id', '=', 'catagories.id')
            ->join('concert_details', 'catagories.concert_detail_id', '=', 'concert_details.id')
            ->join('venues', 'catagories.venue_id', '=', 'venues.id')
            ->join('concerts', 'concert_details.concert_id', '=', 'concerts.id')
            ->select('concerts.name', 'concerts.image', DB::raw('COUNT(transactions.id) as Total'))
            ->groupBy('concerts.id')
            ->orderBy('Total', 'desc')
            ->limit(2) // Add the limit here
            ->get()
            ->map(function ($concert, $index) {
                $concert->row_number = $index + 1;
                return $concert;
            });
    }

    private function getBanners()
    {
        return Banner::all();
    }

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

        return view('concert.detail', [
            'concert' => $concert->name,
            'concertDetails' => $details,
            'guestDetails' => $guest,
        ]);
    }

    public function guest($guest)
    {
        $guest = Guest::where('name', $guest)->first();
        // dd($guest);

        return view('concert.guest', [
            'guest' => $guest,
        ]);
    }
}
