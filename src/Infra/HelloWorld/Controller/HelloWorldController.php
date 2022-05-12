<?php

declare(strict_types=1);

namespace App\Infra\HelloWorld\Controller;

use App\Infra\HttpFoundation\Response;
use App\Infra\HttpFoundation\Request;

class HelloWorldController
{
    public function __construct()
    {
    }

    public function __invoke(): Response
    {
        return new Response('Hello World');
    }
}
