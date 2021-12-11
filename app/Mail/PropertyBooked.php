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
     * @var $isHost
     */
    public $isHost;

    /**
     * Create a new message instance.
     *
     * @param object $booking
     */
    public function __construct(object $booking, bool $isHost)
    {
        $this->booking = $booking;
        $this->isHost = $isHost;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return !$this->isHost ? $this->view('emails.booking.success') : $this->view('emails.booking.success-host');
    }
}
