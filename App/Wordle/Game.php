<?php

declare(strict_types=1);

namespace App\Wordle;

use App\Wordle\Exception\IncompleteWordException;
use App\Wordle\Helpers\Letter;

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

    public function getLettersAsString(bool $colorized = false): string
    {
        if (!$colorized){
            return str_pad(implode($this->letters), strlen($this->word), '_');
        }

        $string = '';
        foreach ($this->letters as $place => $stringLetter) {
            $letter = new Letter($stringLetter);
            $valid = $letter->isValidInWord($this->word);
            $placed = $letter->isPlacedInWord($place, $this->word);

            if ($valid && $placed) {
                $string .= "<span style='background-color:#0080ff;width:15px;height:15px;color:white;padding:5px;display: inline-block;text-align: center;line-height:15px;'>$stringLetter</span>";
                continue;
            }

            if ($valid && !$placed) {
                $string .= "<span style='background-color:#ffbb00;width:15px;height:15px;padding:5px;border-radius: 50%;display: inline-block;text-align: center;line-height:15px;'>$stringLetter</span>";
                continue;
            }

            $string .= "<span style='width:15px;padding:5px;border-radius: 50%;height:15px;display: inline-block;text-align: center;line-height:15px;'>$stringLetter</span>";
        }

        return $string;
    }

    public function tryWord(): void
    {
        if ($this->lost) {
            return;
        }

        if (count($this->letters) !== strlen($this->word)) {
            throw new IncompleteWordException();
        }

        $this->trials[] = new Trial($this->getLettersAsString(true));

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
