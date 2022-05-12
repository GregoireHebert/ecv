<?php

declare(strict_types=1);

namespace App\Controller;

use App\Wordle\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route(path:'/', name:'wordle')]
class Wordle extends AbstractController
{
    public ?Game $game = null;

    public function __invoke()
    {
        return $this->render('wordle.html.twig', ['game' => $this->game]);
    }
}
