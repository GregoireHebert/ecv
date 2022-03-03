<?php

declare(strict_types=1);

namespace App\Routing;

use App\Controller\Controller;
use App\Controller\Elo;
use App\Controller\Error404;
use App\Controller\Toto;
use App\Controller\Welcome;

class Router
{
    private array $routes = [
        '/' => Welcome::class,
        '/bidule' => Toto::class,
        '/404' => Error404::class,
        '/elo' => Elo::class
    ];

    private static string $path;

    private static ?Router $router = null;

    private function __construct()
    {
        self::$path = $_SERVER['PATH_INFO'] ?? '/';
    }

    public static function getFromGlobals(): Router
    {
        if (self::$router === null) {
            self::$router = new self();
        }

        return self::$router;
    }

    public function getController(): void
    {
        $controllerClass = $this->routes[self::$path] ?? $this->routes['/404'];
        $controller = new $controllerClass();

        if (!$controller instanceof Controller) {
            throw new \LogicException("controller $controllerClass should implement ".Controller::class);
        }

        $controller->render();
    }
}
