<?php

namespace App\Service;

class Tombstone
{
    public static function bury(): void
    {
        $backtrace = debug_backtrace();
        $zombie = $backtrace[1];
        $method = $zombie['class'] . '::' . $zombie['function'];
        $tombstone = str_replace('\\', '_', $method);
        $graveyard = storage_path('app/graveyard/');

        if (!is_dir($graveyard) && !mkdir($graveyard, 0777, true)) {
            throw new \Exception('failed to create graveyard');
        }

        touch($graveyard . $tombstone);
        $bugsnag_client = ServiceLocator::find(\Bugsnag\Client::class);
        $message = 'Tombstone Triggered for ' . $method;
        $bugsnag_client->notifyError('tombstone', $method);
    }
}
