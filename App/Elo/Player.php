<?php

declare(strict_types=1);

namespace App\Elo;

class Player
{
    //protected int $level;
    //public string $name;

    public function __construct(public int $level = 400, public string $name)
    {
        //$this->level = $level;
        //$this->name = $name;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $newLevel)
    {
        $this->level = $newLevel;
    }
}
