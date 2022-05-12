<?php

declare(strict_types=1);

namespace App\Infra\Home\Controller;

use App\Infra\Home\Logger;
use App\Infra\HttpFoundation\Response;

class HomeController
{
    public function __construct()
    {
    }

    public function __invoke(): Response
    {
        return new Response('Home');
    }
}
