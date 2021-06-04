<?php

declare(strict_types=1);

namespace App\Controller;

use App\Pendu\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path:"/test_letter/{letter}", name:"test_letter")]
class TryLetter extends AbstractController
{
    public function __invoke(Game $pendu, SessionInterface $session, string $letter)
    {
        if ($session->get('word') ===  null) {
            return $this->redirectToRoute('game');
        }

        $lettreTentees = $session->get('lettresTentees', []);
        $lettresTrouvees = $session->get('lettresTrouvees', []);
        $motTableau = str_split($session->get('word'));

        if (in_array(strtolower($letter), $lettreTentees)) {
            $tenta = $session->get('tenta');
            $session->set('tenta', --$tenta);

            return $this->forward(Home::class);
        }

        $lettreTentees[] = strtolower($letter);
        $lettreTentees = array_unique($lettreTentees);
        $session->set('lettresTentees', $lettreTentees);

        if ($pendu->tryLetter($letter, $session->get('word'))) {
            $lettresTrouvees[] = strtolower($letter);
            $lettresTrouvees = array_unique($lettresTrouvees);
            $session->set('lettresTrouvees', $lettresTrouvees);

            $intersect = array_intersect($lettresTrouvees, $motTableau);
            if (count($intersect) === count(array_unique($motTableau))) {
                return $this->forward(Victory::class);
            }

            return $this->forward(Home::class);
        }

        $tenta = $session->get('tenta');
        $session->set('tenta', --$tenta);

        return $this->forward(Home::class);
    }
}
