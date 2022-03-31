<?php

declare(strict_types=1);

namespace App\EventsListener;

use App\Controller\Wordle;
use App\Infra\EventsDispatcher\Events\ControllerEvent;
use App\Infra\EventsDispatcher\ListenerInterface;
use App\Infra\Repository\GameRepository;

class SaveGame implements ListenerInterface
{
    public function support($event): bool
    {
        return $event instanceof ControllerEvent;
    }

    /** @param ControllerEvent $event */
    public function notify($event)
    {
        if (!$event->controller instanceof Wordle) {
            return;
        }

        $router = $event->router;
        $controller = $event->controller;

        $gameRepository = new GameRepository($router);
        $gameRepository->save($controller->game);
    }
}
