<?php

declare(strict_types=1);

namespace App\Infra\EventDispatcher;

use App\Infra\EventListener\SecurityListener;

class EventDispatcher
{
    private array $listeners = [];

    public function __construct()
    {
        $this->listeners[] = new SecurityListener();
    }

    public function dispatch($event)
    {
        foreach ($this->listeners as $listener){
            if ($listener->support($event)) {
                $listener->notify($event);
            }
        }
    }
}
