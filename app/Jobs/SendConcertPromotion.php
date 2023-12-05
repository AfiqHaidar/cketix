<?php

namespace App\Jobs;

use App\Mail\PromotionMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendConcertPromotion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $top = DB::table('transactions')
            ->join('tickets', 'transactions.id', '=', 'tickets.transaction_id')
            ->join('catagories', 'tickets.catagory_id', '=', 'catagories.id')
            ->join('concert_details', 'catagories.concert_detail_id', '=', 'concert_details.id')
            ->join('venues', 'catagories.venue_id', '=', 'venues.id')
            ->join('concerts', 'concert_details.concert_id', '=', 'concerts.id')
            ->select('concerts.id', 'venues.name as vname', 'concerts.name', 'concerts.image', DB::raw('COUNT(transactions.id) as Total'))
            ->groupBy('concerts.id', 'venues.name') // Include venues.name in GROUP BY
            ->orderBy('Total', 'desc')
            ->limit(1)
            ->get()
            ->map(function ($concert) {
                $concert->row_number = 1; // Since there's only one result, set row_number to 1
                return $concert;
            });

        dd($top[0]);

        $email = new PromotionMail($this->user, $top[0]);
        Mail::to($this->user->email)->send($email);
    }
}
