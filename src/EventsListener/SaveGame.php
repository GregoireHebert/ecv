<?php

declare(strict_types=1);

namespace App\EventsListener;

use App\Controller\Wordle;
use App\Infra\Repository\GameRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class SaveGame implements EventSubscriberInterface
{
    private Request $router;
    public function __construct(RequestStack $requestStack)
    {
        $this->router = $requestStack->getCurrentRequest();
    }

    public static function getSubscribedEvents()
    {
        return [KernelEvents::CONTROLLER => ['notify', 1]];
    }

    public function notify(ControllerEvent $event)
    {
        $controller = $event->getController();
        if (!$controller instanceof Wordle) {
            return;
        }


        $gameRepository = new GameRepository($this->router);
        $gameRepository->save($controller->game);
    }
}
