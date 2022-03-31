<?php

declare(strict_types=1);

namespace App\Infra\Repository;

use App\Routing\Router;
use App\Wordle\Game;

class GameRepository
{
    public function __construct(private Router $router)
    {
    }

    public function getCurrentGame(): ?Game
    {
        if (null !== $wordle = $this->router->getCookie('wordle')) {
            return unserialize($wordle, ['allowed_classes' => [Game::class]]);
        }

        return null;
    }

    public function save(Game $game): void
    {
        setcookie('wordle', serialize($game), 0, "/", "localhost", false, true);
    }
}
