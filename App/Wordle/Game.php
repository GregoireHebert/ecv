<?php

declare(strict_types=1);

namespace App\Wordle;

use App\Wordle\Exception\IncompleteWordException;

class Game
{
    public array $letters = [];
    public bool $won = false;
    public bool $lost = false;
    public array $trials = [];

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
        if ($this->lost) {
            return;
        }

        if (count($this->letters) !== strlen($this->word)) {
            throw new IncompleteWordException();
        }

        $this->trials[] = new Trial(implode($this->letters));

        if ($this->word === implode($this->letters)) {
            $this->won = true;
        }

        if (count($this->trials) === 6 && !$this->won) {
            $this->lost = true;
        }

        $this->resetletters();
    }

    public function addletter(string $letter): void
    {
        if ($this->lost || count($this->letters) === strlen($this->word)) {
            return;
        }

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

    public function isLost(): bool
    {
        return $this->lost;
    }

    public function getTrials(): array
    {
        return $this->trials;
    }
}
