<?php

declare(strict_types=1);

namespace App\Controller;

use App\Pendu\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path:"/", name:"game")]
class Home extends AbstractController
{
    public function __invoke(Game $game, SessionInterface $session)
    {
        if (null === $session->get('word')) {
            $session->set('word', $game->getRandomWord());
        }

        if (null === $session->get('lettresTrouvees')) {
            $session->set('lettresTrouvees', []);
        }

        if (null === $session->get('lettresTentees')) {
            $session->set('lettresTentees', []);
        }

        if (null === $tenta = $session->get('tenta')) {
            $session->set('tenta', 11);
        }

        if ($tenta <= 0) {
            return $this->redirectToRoute('lose');
        }

        $motTableau = str_split($session->get('word'));

        $lettresTrouvees = $session->get('lettresTrouvees', []);

        foreach ($motTableau as &$lettre)
        {
            if (!in_array(strtolower($lettre), $lettresTrouvees)) {
                $lettre = ' _ ';
            }
        }

        return $this->render('game.html.twig', [
            'mot' => implode('', $motTableau)
        ]);
    }
}
