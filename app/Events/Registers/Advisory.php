<?php

namespace App\Events\Registers;

use App\Events\Event;

class Advisory extends Event
{
    public $user;

    public function __construct ($user) {
        $this->user = $user;
    }
}
