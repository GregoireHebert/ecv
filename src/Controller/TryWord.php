<?php

declare(strict_types=1);

namespace App\Controller;

use App\Pendu\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path:"/test_mot", name:"test_mot")]
class TryWord extends AbstractController
{
    public function __invoke(Game $pendu, SessionInterface $session, RequestStack $requestStack)
    {
        $request = $requestStack->getCurrentRequest();

        if (null !== $mot = $request->get('word')) {
            if (null === $atrouver = $session->get('word')) {
                return $this->redirectToRoute('init');
            }

            $session->set('tenta', 0);

            if (strtolower($mot) === $atrouver) {
                return $this->redirectToRoute('win');
            }

            return $this->redirectToRoute('lose');
        }

        return $this->redirectToRoute('game');
    }
}
