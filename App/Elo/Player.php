<?php

declare(strict_types=1);

namespace App\Elo;

class Player
{
    //protected int $level;

    public function __construct(protected int $level = 400)
    {
        //$this->level = $level;
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
