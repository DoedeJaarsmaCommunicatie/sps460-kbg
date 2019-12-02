<?php

namespace App\Listeners\Registers\Advisory;

use App\Events\Registers\Advisory;
use Illuminate\Support\Facades\Mail;
use App\Mail\Advisory\NotificationMail;

class SendNewRegisterNotification
{
    public function handle(Advisory $advisoryEvent): void
    {
        Mail::to('mail@doedejaarsma.nl')
            ->send(new NotificationMail($advisoryEvent->user));
    }
}
