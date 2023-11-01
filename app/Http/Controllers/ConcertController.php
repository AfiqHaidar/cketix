<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;

class ConcertController extends Controller
{
    public function index()
    {
        $concert = Concert::all();

        return view('concert.index', [
            'concerts' => $concert,
        ]);
    }
}
