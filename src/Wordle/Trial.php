<?php

declare(strict_types=1);

namespace App\Wordle;

class Trial
{
    public function __construct(public string $word)
    {
    }

    public function __toString(): string
    {
        return $this->word;
    }
}
