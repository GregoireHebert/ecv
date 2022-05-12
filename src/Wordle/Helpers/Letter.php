<?php

declare(strict_types=1);

namespace App\Wordle\Helpers;

class Letter
{
    public function __construct(private string $letter)
    {
    }

    public function isValidInWord(string $word): bool
    {
        return false !== strpos($word, $this->letter);
    }

    public function isPlacedInWord(int $place, string $word): bool
    {
        return $this->letter === $word[$place];
    }
}
