<?php

declare(strict_types=1);

namespace App\Infra\Error\Controller;

use App\Infra\HttpFoundation\Response;

class Error404Controller
{
    public function __invoke(): Response
    {
        return new Response('404 Not Found');
    }
}
