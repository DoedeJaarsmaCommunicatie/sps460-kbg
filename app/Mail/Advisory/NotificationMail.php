<?php

namespace App\Mail\Advisory;

use Illuminate\Mail\Mailable;

class NotificationMail extends Mailable
{
    public $user;

    public function __construct ($user)
    {
        $this->user = $user;
    }

    public function build(): NotificationMail
    {
        return $this->from('info@spaarndammerstraat460.nl', 'Team Spaarndammerstraat')
            ->subject(__('mails/advisors.notification.subject'))
            ->view('Mail.Advisory.notification');
    }
}
