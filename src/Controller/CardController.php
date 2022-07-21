<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class CardController extends AbstractController
{
    #[Route('/collection', name: 'card')]
    #[IsGranted('ROLE_USER')]
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
