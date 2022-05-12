<?php

declare(strict_types=1);

namespace App\Infra\EventListener;

use App\Infra\EventDispatcher\Events\RequestEvent;
use App\Infra\HttpFoundation\Response;

class SecurityListener
{
    public function support($event): bool
    {
        return $event instanceof RequestEvent;
    }

    public function notify(RequestEvent $requestEvent)
    {
        $request = $requestEvent->getRequest();
        $key = $request->getQuery('key');

        if ($key === null) {
            $requestEvent->setRequest(
                new Response('Key missing')
            );
        }
    }
}
