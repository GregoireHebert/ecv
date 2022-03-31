<?php

declare(strict_types=1);

namespace App\Wordle;

use App\Wordle\Exception\IncompleteWordException;

class Game
{
    public array $letters = [];
    public bool $won = false;

    public function __construct(private string $word)
    {
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function getLettersAsString(): string
    {
        return str_pad(implode($this->letters), strlen($this->word), '_');
    }

    public function tryWord(): void
    {
        if (count($this->letters) !== strlen($this->word)) {
            throw new IncompleteWordException();
        }

        if ($this->word === implode($this->letters)) {
            $this->won = true;
        }
    }

    public function addletter(string $letter): void
    {
        $this->letters[] = $letter;
    }

    public function resetletters(): void
    {
        $this->letters = [];
    }

    public function isWon(): bool
    {
        return $this->won;
    }
}
