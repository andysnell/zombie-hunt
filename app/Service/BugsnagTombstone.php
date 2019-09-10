<?php

namespace App\Service;

class BugsnagTombstone
{
    public function bury(): void
    {
        $backtrace = debug_backtrace();
        $zombie = $backtrace[1];
        $method = $zombie['class'] . '::' . $zombie['function'];
        $message = 'Tombstone Triggered for ' . $method;
        $this->bugsnag_client->notifyError('tombstone', $method);
    }
}
