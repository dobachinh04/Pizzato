<?php

namespace App\Console\Commands;

use App\Notifications\OrderPendingNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Console\Command;
use Illuminate\Notifications\AnonymousNotifiable;

class TestNotifications extends Command
{
    protected $signature = 'notifications:test';
    protected $description = 'Test sending a notification to the database';

    public function handle()
    {
        Notification::sendNow(
            new AnonymousNotifiable(),
            new OrderPendingNotification('Test notification content.')
        );

        $this->info('Test notification sent. Check the notifications table.');
    }
}
