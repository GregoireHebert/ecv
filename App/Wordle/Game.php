<?php

declare(strict_types=1);

namespace App\Wordle;

class Game
{
    public array $letters = [];

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

    public function addletter(string $letter): void
    {
        $this->letters[] = $letter;
    }

    public function resetletters(): void
    {
        $this->letters = [];
    }
}
