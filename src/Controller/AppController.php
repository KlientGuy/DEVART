<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'app_index', methods: ['GET'])]
    public function index()
    {
        return $this->render('app/index.html.twig');
    }

    #[Route('/offer', name: 'app_offer', methods: ['GET'])]
    public function offer()
    {
        return $this->render('app/offer.html.twig');
    }
}
