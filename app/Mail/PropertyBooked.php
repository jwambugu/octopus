<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PropertyBooked extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Booking
     */
    public $booking;

    /**
     * Create a new message instance.
     *
     * @param object $booking
     */
    public function __construct(object $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        info('sending email');
        return $this->view('emails.booking.success');
    }
}
