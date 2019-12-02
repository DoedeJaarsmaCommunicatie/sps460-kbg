<?php

namespace App\Events\Registers;

use App\Events\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class Advisory extends Event
{
    /**
     * @var Builder $user
     */
    public $user;

    public function __construct (int $user_id) {
        $this->user = DB::table('users')->find($user_id);
    }
}
