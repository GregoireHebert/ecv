<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infra\Repository\WordRepository;

class Wordle implements Controller
{
    private WordRepository $wordRepository;

    public function __construct()
    {
        $this->wordRepository = new WordRepository();
    }

    public function render()
    {
        $randomWord = $this->wordRepository->getRandomWord();
        echo $randomWord;
    }
}
