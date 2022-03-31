<?php

declare(strict_types=1);

namespace App\EventsListener;

use App\Controller\Wordle;
use App\Infra\EventsDispatcher\Events\ControllerEvent;
use App\Infra\EventsDispatcher\ListenerInterface;
use App\Wordle\GameLoader;

class NewGame implements ListenerInterface
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

        $game = $event->controller->game;
        $router = $event->router;

        if (null !== $router->get('new') && $game->isWon()) {
            $game->resetletters();
            $gameLoader = new GameLoader($event->router);
            $game = $gameLoader->load(true);

            $event->controller->game = $game;
        }
    }
}
