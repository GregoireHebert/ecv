<?php

declare(strict_types=1);

namespace App\Infra;

use App\Infra\EventDispatcher\EventDispatcher;
use App\Infra\EventDispatcher\Events\RequestEvent;
use App\Infra\HttpFoundation\Request;
use App\Infra\HttpFoundation\Response;
use App\Infra\HttpFoundation\Router;

class HttpKernel
{
    public function handle(Request $request)
    {
        $eventDispatcher = new EventDispatcher();

        $requestEvent = new RequestEvent($request);
        $eventDispatcher->dispatch($requestEvent);
        $request = $requestEvent->getRequest();

        if ($request instanceof Response) {
            $request->send();
            exit(1);
        }

        $router = new Router();

        $controllerClass = $router->getController($request);
        //$arguments = $container->resolveArguments($controllerClass, '__construct');
        // ControllerArgumentsEvent

        $controller = new $controllerClass();
        // ControllerEvent

        $response = $controller();
        // ViewEvent

        // ResponseEvent

        $response->send();
        // TerminateEvent
    }
}
