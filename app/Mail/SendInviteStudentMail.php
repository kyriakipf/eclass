<?php

namespace App\Mail;

use App\Models\InviteStudent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInviteStudentMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $invite;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(InviteStudent $invite)
    {
        $this->invite = $invite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('eclass@email.com')->subject('Email Ενεργοποίησης')->markdown('emails.sendInviteStudent', ['invite' => $this->invite]);
    }
}
