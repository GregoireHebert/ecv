<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infra\Repository\WordRepository;
use App\Wordle\Game;

class Wordle implements Controller
{
    private WordRepository $wordRepository;
    public ?Game $game = null;

    public function __construct()
    {
        $this->wordRepository = new WordRepository();
    }

    public function render()
    {
        var_dump($this->game);
    }
}
