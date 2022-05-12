<?php

declare(strict_types=1);

namespace App\Wordle;

use App\Infra\Repository\GameRepository;
use App\Infra\Repository\WordRepository;
use App\Routing\Router;
use Symfony\Component\HttpFoundation\Request;

class GameLoader
{
    private WordRepository $wordRepository;

    public function __construct(Request $router)
    {
        $this->wordRepository = new WordRepository();
        $this->gameRepository = new GameRepository($router);
    }

    public function load(bool $force = false): Game
    {
        if($force || (null === $game = $this->gameRepository->getCurrentGame())) {
            $randomWord = $this->wordRepository->getRandomWord();
            $game = new Game($randomWord);
        }

        return $game;
    }
}
