<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;


class CardController extends AbstractController
{
    #[Route('/collection', name: 'card')]
    public function index(CallApiService $callApiService): Response
    {
        /** @var User  */
        $user = $this->getUser();
        $collection = $user->getCards();
        return $this->render('card/index.html.twig', [
            'data' => $callApiService->getCardData(),
            'collection' => $collection,
            'user' => $user,
        ]);
    }
}
