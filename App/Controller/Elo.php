<?php

declare(strict_types=1);

namespace App\Controller;

use App\Elo\Encounter;
use App\Elo\Lobby;
use App\Elo\Player;

class Elo implements Controller
{
    public function render()
    {
        $greg = new Player(400);
        $jade = new Player(800);

        echo sprintf(
            'Greg à %.2f%% chance de gagner face a Jade',
                Encounter::probabilityAgainst($greg, $jade) * 100
        ) . PHP_EOL;

        // Imaginons que greg l'emporte tout de même.
        Encounter::setNewLevel($greg, $jade, Encounter::RESULT_WINNER);
        Encounter::setNewLevel($jade, $greg, Encounter::RESULT_LOSER);

        echo sprintf(
            'les niveaux des joueurs ont évolués vers %s pour Greg et %s pour Jade',
            $greg->getLevel(),
            $jade->getLevel()
        );

        $lobby = new Lobby();
        $lobby->addPlayer($greg);
    }
}
