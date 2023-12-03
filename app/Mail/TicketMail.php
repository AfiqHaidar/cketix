<?php

namespace App\Mail;

use App\Models\Catagory;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public Transaction $transaction;
    public Catagory $catagory;
    public User $user;

    public function __construct($ticket,  Transaction $transaction,  Catagory $catagory,  User $user)
    {
        $this->ticket = $ticket;
        $this->transaction = $transaction;
        $this->catagory = $catagory;
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ticket Mail',
        );
    }

    public function content(): Content
    {
        return (new Content())
            ->view('emails.transaction')
            ->with([
                'ticket' => $this->ticket,
                'transaction' => $this->transaction,
                'catagory' => $this->catagory,
                'user' => $this->user,
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
