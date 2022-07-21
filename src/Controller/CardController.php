<?php

namespace App\Controller;

use App\Entity\Card;
use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\CardRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

class CardController extends AbstractController
{
    #[Route('/collection', name: 'card')]
    #[IsGranted('ROLE_USER')]
    public function index(CallApiService $callApiService): Response
    {
        /** @var User  */
        $user = $this->getUser();
        $cards = $user->getCards();
   
        return $this->render('card/index.html.twig', [
            'data' => $callApiService->getCardData(),
            'cards' => $cards,
            'user' => $user,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'card_delete', methods: ['POST'])]
    public function delete(Request $request, Card $card, CardRepository $cardRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $card->getId(), $request->request->get('_token'))) {
            $cardRepository->remove($card, true);
            $this->addFlash('success', 'Vous avez bien supprimer la carte !');
        }

        return $this->redirectToRoute('card', [], Response::HTTP_SEE_OTHER);
    }
}
