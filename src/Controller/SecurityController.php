<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Exception;

class SecurityController extends AbstractController
{
    #[Route('/Deconnexion', name: 'logout', methods: ['GET'])]
    public function logout(): void
    {
        throw new Exception('Don\'t forget to activate logout in security.yaml');
    }
}
