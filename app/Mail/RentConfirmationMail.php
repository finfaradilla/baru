<?php

namespace App\Mail;

use App\Models\Rent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Rent $rent)
    {
        $this->rent = $rent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Room Rent Confirmation')
                    ->view('emails.rent_confirmation')
                    ->with('rent', $this->rent);
    }
}
