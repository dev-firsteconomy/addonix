<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $leads;
    public $leadProducts;
    public $leadPoc;
    public $lead_interaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($leads,$leadProducts,$leadPoc,$lead_interaction)
    {
        $this->leads = $leads;
        $this->leadProducts = $leadProducts;
        $this->leadPoc = $leadPoc;
        $this->lead_interaction = $lead_interaction;
    }

    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.approval',['lead'=>$this->leads,'leadProducts'=>$this->leadProducts,'leadPoc'=>$this->leadPoc,'lead_interaction'=>$this->lead_interaction])->subject('NEW LEAD TEST EMAIL');
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
