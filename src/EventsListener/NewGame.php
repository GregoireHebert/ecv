<?php

declare(strict_types=1);

namespace App\EventsListener;

use App\Controller\Wordle;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use App\Wordle\GameLoader;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class NewGame implements EventSubscriberInterface
{
    private Request $router;
    public function __construct(RequestStack $requestStack)
    {
        $this->router = $requestStack->getCurrentRequest();
    }

    public static function getSubscribedEvents()
    {
        return [KernelEvents::CONTROLLER => ['notify', 5]];
    }

    public function notify(ControllerEvent $event)
    {
        $controller = $event->getController();
        if (!$controller instanceof Wordle) {
            return;
        }

        $game = $controller->game;

        if (null !== $this->router->get('new') && ($game->isWon() || $game->isLost())) {
            $game->resetletters();
            $gameLoader = new GameLoader($this->router);
            $game = $gameLoader->load(true);

            $controller->game = $game;
        }
    }
}
