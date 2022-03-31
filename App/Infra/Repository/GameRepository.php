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
            // TODO
        }

        return null;
    }
}
