<?php

namespace App\Listeners\Registers\Advisory;

use App\Events\Registers\Advisory;
use Illuminate\Support\Facades\Mail;
use App\Mail\Advisory\AdvisoryConfirmationMail;

class SendConfirmationNotification
{
    public function handle(Advisory $advisoryEvent): void
    {
        Mail::to($advisoryEvent->user->email)
            ->send(new AdvisoryConfirmationMail($advisoryEvent->user));
    }
}
