<?php

namespace App\Mail;

use App\Models\InviteTeacher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInviteTeacherMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $invite;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(InviteTeacher $invite)
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
        return $this->from('eclass@email.com')->subject('Email Ενεργοποίησης')->markdown('emails.sendInviteTeacher', ['invite' => $this->invite]);
    }
}
