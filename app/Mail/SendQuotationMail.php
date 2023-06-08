<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendQuotationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $leads;
    // public $lead_quotations;
    // public $products;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($leads)
    {
        $this->leads = $leads;
        // $this->lead_quotations = $lead_quotations;
    }

    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.quotation',['lead'=>$this->leads])->subject('PRODUCT QUOTATION EMAIL');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
