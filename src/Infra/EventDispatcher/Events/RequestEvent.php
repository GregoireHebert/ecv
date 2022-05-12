<?php

declare(strict_types=1);

namespace App\Infra\EventDispatcher\Events;

use App\Infra\HttpFoundation\Request;
use App\Infra\HttpFoundation\Response;

class RequestEvent
{
    private Request|Response $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getRequest(): Request|Response
    {
        return $this->request;
    }

    public function setRequest(Request|Response $request): void
    {
        $this->request = $request;
    }
}
