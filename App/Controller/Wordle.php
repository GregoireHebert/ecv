<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infra\Templating\Templating;
use App\Wordle\Game;

class Wordle implements Controller
{
    public ?Game $game = null;
    public ?Templating $templating = null;

    public function __construct()
    {
        $this->templating = new Templating();
    }

    public function render()
    {
        $this->templating->loadTemplate(PUBLIC_DIR.'/../templates/wordle.phtml', ['game' => $this->game]);
    }
}
