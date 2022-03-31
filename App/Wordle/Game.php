<?php

declare(strict_types=1);

namespace App\Wordle;

class Game
{
    public function __construct(private string $word)
    {
    }

    public function getWord(): string
    {
        return $this->word;
    }
}
