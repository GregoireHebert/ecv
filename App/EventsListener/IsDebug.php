<?php

declare(strict_types=1);

namespace App\EventsListener;

use App\Infra\EventsDispatcher\Events\ContentEvent;
use App\Infra\EventsDispatcher\ListenerInterface;

class IsDebug implements ListenerInterface
{
    public function support($event): bool
    {
        return $event instanceof ContentEvent;
    }

    /** @param ContentEvent $event */
    public function notify($event)
    {
        if (APP_ENV==='dev') {
            $event->content .= 'info en plus';
        }
    }
}
