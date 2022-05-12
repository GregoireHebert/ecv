<?php

declare(strict_types=1);

namespace App\Infra\HttpFoundation;

use App\Infra\Error\Controller\Error404Controller;
use App\Infra\HelloWorld\Controller\HelloWorldController;
use App\Infra\Home\Controller\HomeController;

class Router
{
    private array $routes;

    public function __construct()
    {
        $this->routes['/'] = HomeController::class;
        $this->routes['/world'] = HelloWorldController::class;
        $this->routes['/404'] = Error404Controller::class;
    }

    public function getController(Request $request): string
    {
        return $this->routes[$request->getPath()] ?? $this->routes['/404'];
    }
}
