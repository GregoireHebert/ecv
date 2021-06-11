<?php

declare(strict_types=1);

namespace App\Controller;

use App\Pendu\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/init', name: 'init')]
class Reset extends AbstractController
{
    public function __invoke(Game $game, SessionInterface $session): Response
    {
        $session->set('word', $game->getRandomWord());
        $session->set('lettresTrouvees', []);
        $session->set('lettresTentees', []);
        $session->set('tenta', 11);

        return $this->redirectToRoute('game');
    }
}
