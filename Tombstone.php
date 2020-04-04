<?php

namespace App\Service;

class Tombstone
{
    public static function exhume(): void
    {
        $backtrace = debug_backtrace();

        $zombie = $backtrace[1];

        $method = $zombie['class'] . '::' . $zombie['function'];

        $tombstone = str_replace('\\', '_', $method);

        $graveyard = __DIR__ . '/path/to/graveyard/';

        if (!is_dir($graveyard) && !mkdir($graveyard, 0644, true)) {
            throw new \Exception('failed to create graveyard');
        }

        touch($graveyard . $tombstone);
    }
}
