<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice, $details)
    {
        $this->invoice = $invoice;
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invoice = $this->invoice;
        $details = $this->details;
        return $this->view('mails.invoice', compact('invoice', 'details'));
    }
}
