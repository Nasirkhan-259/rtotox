<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailItinerary extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user array
     *
     * @var array
     */
    public $user;

    /**
     * The itineraries list.
     *
     * @var array
     */
    public $itineraries;

    /**
     * The flight search request payload.
     *
     * @var array
     */
    public $flightSearchRequest;


    /**
     * Create a new message instance.
     *
     * MailItinerary constructor.
     * @param array $user
     * @param array $itineraries
     * @param array $flightSearchRequest
     * @return void
     */
    public function __construct($user = array(), $itineraries = array(), $flightSearchRequest = array())
    {
        $this->user = $user;
        $this->itineraries = $itineraries;
        $this->flightSearchRequest = $flightSearchRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.corporate.mail_itinerary_to_user');
    }
}
