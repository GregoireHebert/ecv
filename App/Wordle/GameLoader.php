<?php

declare(strict_types=1);

namespace App\Wordle;

use App\Infra\Repository\GameRepository;
use App\Infra\Repository\WordRepository;
use App\Routing\Router;

class GameLoader
{
    private WordRepository $wordRepository;

    public function __construct(Router $router)
    {
        $this->wordRepository = new WordRepository();
        $this->gameRepository = new GameRepository($router);
    }

    public function load(): Game
    {
        if (null === $game = $this->gameRepository->getCurrentGame()) {
            $randomWord = $this->wordRepository->getRandomWord();
            $game = new Game($randomWord);
        }

        return $game;
    }
}
