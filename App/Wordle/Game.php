<?php

declare(strict_types=1);

namespace App\Wordle;

use App\Wordle\Exception\IncompleteWordException;
use App\Wordle\Helpers\Letter;

class Game
{
    public array $letters = [];
    public array $placeholder = [];
    public bool $won = false;
    public bool $lost = false;
    public array $trials = [];

    public function __construct(private string $word)
    {
        $this->placeholder  = [strtoupper($word[0])] + array_fill(0,  strlen($word), '_');
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function getLettersAsString(): string
    {
        return empty($this->letters) ?
            implode(' ', $this->placeholder) :
            implode(' ', $this->letters + array_fill(0,  strlen($this->word), '_'));
    }

    public function getLettersAsStringColorized(): string
    {
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

    public function updatePlaceholder(): void
    {
        foreach ($this->letters as $place => $stringLetter) {
            $letter = new Letter($stringLetter);
            $valid = $letter->isValidInWord($this->word);
            $placed = $letter->isPlacedInWord($place, $this->word);

            $this->placeholder[$place] = $valid && $placed ? $stringLetter : '_';
        }
    }

    public function tryWord(): void
    {
        if ($this->lost) {
            return;
        }

        if (count($this->letters) !== strlen($this->word)) {
            throw new IncompleteWordException();
        }

        $this->trials[] = new Trial($this->getLettersAsStringColorized());

        if ($this->word === implode($this->letters)) {
            $this->won = true;
        }

        if (count($this->trials) === 6 && !$this->won) {
            $this->lost = true;
        }

        $this->updatePlaceholder();
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
