<?php

declare(strict_types=1);

namespace App\Infra\Repository;

use App\Wordle\Game;
use App\Wordle\Trial;
use Symfony\Component\HttpFoundation\Request;

class GameRepository
{
    public function __construct(private Request $router)
    {
    }

    public function getCurrentGame(): ?Game
    {
        if (null !== $wordle = $this->router->cookies->get('wordle')) {
            return unserialize($wordle, ['allowed_classes' => [Game::class, Trial::class]]);
        }

        return null;
    }

    public function save(Game $game): void
    {
        setcookie('wordle', serialize($game), 0, "/", "localhost", false, true);
    }
}
