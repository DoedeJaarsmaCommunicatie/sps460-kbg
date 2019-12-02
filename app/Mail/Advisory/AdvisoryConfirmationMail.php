<?php

namespace App\Mail\Advisory;

use Illuminate\Mail\Mailable;

class AdvisoryConfirmationMail extends Mailable
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build(): AdvisoryConfirmationMail
    {
        return $this->from('info@spaarndammerstraat460.nl', 'Team Spaarndammerstraat')
                    ->subject(__('mails/advisors.confirmation.subject'))
                    ->view('Mail.Advisory.confirmation');
    }
}
