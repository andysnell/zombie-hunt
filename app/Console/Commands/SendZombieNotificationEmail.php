<?php

namespace App\Console\Commands;

use App\Notifications\ZombiesFound;
use FilesystemIterator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use SplFileInfo;

class SendZombieNotificationEmail extends Command
{
    protected $signature = 'zombies:send-email';

    protected $description = 'Send an email listing any Zombies in the App Graveyard';

    public function handle()
    {
        $files = new FilesystemIterator(storage_path('app/graveyard'));
        $zombies = array_map(function (SplFileInfo $file) {
            return $file->getFilename();
        }, iterator_to_array($files));

        if (count($zombies)) {
            Notification::route('mail', 'developers@example.com')
                ->notify(new ZombiesFound($zombies));
        }
    }
}
