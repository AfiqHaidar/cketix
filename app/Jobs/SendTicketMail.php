<?php

namespace App\Jobs;

use App\Mail\TicketMail;
use App\Models\Catagory;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTicketMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $ticket;
    public $transaction;
    public $catagory;
    public $user;

    /**
     * Create a new job instance.
     */
    public function __construct($ticket, $transaction, $catagory, $user)
    {
        $this->ticket = $ticket;
        $this->transaction = $transaction;
        $this->catagory = $catagory;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new TicketMail($this->ticket, $this->transaction, $this->catagory,  $this->user);
        Mail::to($this->user->email)->send($email);
    }
}
