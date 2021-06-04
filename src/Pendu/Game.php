<?php

declare(strict_types=1);

namespace App\Pendu;

class Game
{
    private array $mots;

    public function __construct(string $pathList)
    {
        if (!file_exists($pathList)) {
            throw new \LogicException("File '$pathList' does not exists");
        }

        $fileContent = file_get_contents($pathList);
        $this->mots = array_filter(explode(\PHP_EOL, $fileContent));
    }

    public function getRandomWord(): string
    {
        return $this->mots[array_rand($this->mots, 1)];
    }

    public function tryLetter(string $letter, string $word)
    {
        if (\strlen($letter) > 1) {
            throw new \RuntimeException('It cannot be more than 1 letter tested.');
        }

        return \in_array(strtolower($letter), str_split($word), true);
    }
}
