<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $order;
    public $services;

    public function __construct($order, $services)
    {
        //
        $this->order = $order;
        $this->services = $services;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

            $subject = "CVMAMA CAREER SERVICES";
        

        return $this->subject($subject)
                    ->view('emails.send_order')
                    ->attach($this->order->attachment);
    }
}
